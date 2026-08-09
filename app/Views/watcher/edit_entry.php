<?= $this->extend('templates/main') ?>
<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="/watcher/entries" class="text-indigo-600 hover:text-indigo-800 flex items-center gap-2 mb-4">
            ← Back to Entries
        </a>
        <h1 class="text-3xl font-bold text-slate-800">Edit Entry</h1>
        <p class="text-slate-500 mt-2">Modify recorded passage details</p>
    </div>
    
    <?php if(session()->getFlashdata('error')): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-700 font-bold rounded-2xl border border-red-100">
            ⚠ <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <div class="bg-white rounded-3xl shadow-xl p-8">
        <form action="/watcher/updateEntry/<?= $entry['id'] ?>" method="POST">
            <div class="mb-6">
                <label class="block text-slate-600 font-bold mb-3">Current Entry Details</label>
                <div class="bg-slate-50 p-4 rounded-xl mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Bib Number</p>
                            <p class="font-bold text-indigo-600 text-xl">#<?= $entry['bib_number'] ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Runner Name</p>
                            <p class="font-bold"><?= esc($entry['name']) ?></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase">Recorded Time</p>
                            <p class="font-mono"><?= date('M d, Y h:i A', strtotime($entry['recorded_at'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <label for="runner_id" class="block text-slate-600 font-bold mb-3">Change Runner (Optional)</label>
                <select name="runner_id" id="runner_id" class="w-full p-4 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                    <option value="<?= $entry['runner_id'] ?>">Current: #<?= $entry['bib_number'] ?> - <?= esc($entry['name']) ?></option>
                    <option disabled>──────────</option>
                    <?php foreach($runners as $runner): ?>
                        <?php if($runner['id'] != $entry['runner_id']): ?>
                            <option value="<?= $runner['id'] ?>">
                                #<?= $runner['bib_number'] ?> - <?= esc($runner['name']) ?>
                            </option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <p class="text-sm text-slate-500 mt-2">Leave as is to keep the same runner, or select a different one.</p>
            </div>
            
            <div class="mb-6">
                <label for="recorded_at" class="block text-slate-600 font-bold mb-3">Change Time (Optional)</label>
                <input type="datetime-local" name="recorded_at" id="recorded_at" 
                       value="<?= date('Y-m-d\TH:i', strtotime($entry['recorded_at'])) ?>"
                       class="w-full p-4 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                <p class="text-sm text-slate-500 mt-2">Update the recorded time if needed.</p>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition shadow-lg">
                    Update Entry
                </button>
                <a href="/watcher/entries" class="flex-1 bg-slate-100 text-slate-700 py-4 rounded-xl font-bold hover:bg-slate-200 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
        
        <div class="mt-8 pt-6 border-t border-slate-200">
            <div class="bg-red-50 p-4 rounded-xl">
                <p class="text-red-700 text-sm font-bold mb-2">⚠️ Danger Zone</p>
                <p class="text-red-600 text-sm mb-3">This will permanently remove this entry from the race log.</p>
                <a href="/watcher/deleteEntry/<?= $entry['id'] ?>" 
                   onclick="return confirm('Are you ABSOLUTELY sure? This cannot be undone!')"
                   class="inline-block bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-700 transition">
                    Delete This Entry
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>