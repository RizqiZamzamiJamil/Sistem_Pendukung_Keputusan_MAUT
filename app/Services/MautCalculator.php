<?php

namespace App\Services;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;

class MautCalculator
{
    public function calculate(): array
    {
        $alternatives = model(AlternatifModel::class)
            ->orderBy('id_alternatif', 'ASC')
            ->findAll();
        $criteria = model(KriteriaModel::class)
            ->orderBy('id_kriteria', 'ASC')
            ->findAll();
        $scores = model(PenilaianModel::class)->findAll();

        $scoreMap = [];
        foreach ($scores as $score) {
            $scoreMap[(int) $score['id_alternatif']][(int) $score['id_kriteria']] = (float) $score['nilai'];
        }

        $decisionMatrix = [];
        $minValues = [];
        $maxValues = [];

        foreach ($criteria as $criterion) {
            $criterionId = (int) $criterion['id_kriteria'];
            $values = [];

            foreach ($alternatives as $alternative) {
                $alternativeId = (int) $alternative['id_alternatif'];
                $value = $scoreMap[$alternativeId][$criterionId] ?? 0.0;
                $decisionMatrix[$alternativeId][$criterionId] = $value;
                $values[] = $value;
            }

            $minValues[$criterionId] = $values === [] ? 0.0 : min($values);
            $maxValues[$criterionId] = $values === [] ? 0.0 : max($values);
        }

        $normalizedMatrix = [];
        $weightedMatrix = [];
        $rankings = [];

        foreach ($alternatives as $alternative) {
            $alternativeId = (int) $alternative['id_alternatif'];
            $total = 0.0;

            foreach ($criteria as $criterion) {
                $criterionId = (int) $criterion['id_kriteria'];
                $rawValue = $decisionMatrix[$alternativeId][$criterionId] ?? 0.0;
                $range = $maxValues[$criterionId] - $minValues[$criterionId];
                $normalized = $range == 0.0 ? 0.0 : ($rawValue - $minValues[$criterionId]) / $range;
                $weighted = $normalized * (float) $criterion['bobot'];

                $normalizedMatrix[$alternativeId][$criterionId] = $normalized;
                $weightedMatrix[$alternativeId][$criterionId] = $weighted;
                $total += $weighted;
            }

            $rankings[] = [
                'alternative' => $alternative,
                'total' => $total,
            ];
        }

        usort($rankings, static fn (array $a, array $b): int => $b['total'] <=> $a['total']);

        foreach ($rankings as $index => $ranking) {
            $rankings[$index]['rank'] = $index + 1;
        }

        return [
            'alternatives' => $alternatives,
            'criteria' => $criteria,
            'decisionMatrix' => $decisionMatrix,
            'minValues' => $minValues,
            'maxValues' => $maxValues,
            'normalizedMatrix' => $normalizedMatrix,
            'weightedMatrix' => $weightedMatrix,
            'rankings' => $rankings,
            'totalWeight' => array_sum(array_column($criteria, 'bobot')),
        ];
    }
}
