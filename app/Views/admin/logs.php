<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-bold text-slate-800 text-lg">Live Activity Log</h3>
        <div class="text-sm text-slate-500">
            Total Entries: <?= count($logs) ?>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-400 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Time</th>
                    <th class="px-6 py-4">Runner Name</th>
                    <th class="px-6 py-4">Bib #</th>
                    <th class="px-6 py-4">Checkpoint</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php if(empty($logs)): ?>
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                        No logs available yet
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach($logs as $log): ?>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-mono text-sm">
                            <?= date('Y-m-d H:i:s', strtotime($log['recorded_at'])) ?>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            <?= $log['name'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded text-xs font-mono">
                                <?= $log['bib_number'] ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 px-3 py-1 rounded-full text-xs font-medium">
                                Checkpoint <?= $log['checkpoint_id'] ?? 'N/A' ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>