<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100">
        <h3 class="font-bold text-slate-800 text-lg">Current Race Rankings</h3>
        <p class="text-sm text-slate-500 mt-1">Ranked by furthest checkpoint reached and earliest arrival time</p>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-400 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Rank</th>
                    <th class="px-6 py-4">Bib #</th>
                    <th class="px-6 py-4">Runner Name</th>
                    <th class="px-6 py-4">Last Checkpoint</th>
                    <th class="px-6 py-4">Time at Checkpoint</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($rankings)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                        No race data available yet
                    </td>
                </tr>
                <?php else: ?>
                    <?php $rank = 1; ?>
                    <?php foreach($rankings as $runner): ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <span class="font-bold <?= $rank <= 3 ? 'text-indigo-600' : 'text-slate-600' ?>">
                                #<?= $rank++ ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 px-2 py-1 rounded text-xs font-mono">
                                <?= $runner['bib_number'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            <?= $runner['name'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                <?= $runner['location_name'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-500">
                            <?= date('H:i:s', strtotime($runner['recorded_at'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Optional: Export Button -->
<div class="mt-6 flex justify-end">
    <button onclick="window.print()" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
        Print Report
    </button>
</div>

<?= $this->endSection() ?>