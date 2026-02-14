<?php
include '../../config/database.php';
checkAdmin();
include '../includes/header.php';
include '../includes/sidebar.php';

$orders = $conn->query("SELECT p.*, pl.nama, pl.email FROM pesanan p JOIN pelanggan pl ON p.pelanggan_id = pl.id ORDER BY p.tanggal_pesanan DESC");
?>

<div class="flex-1 p-8">
    <h1 class="text-4xl font-black uppercase mb-8">Data Pesanan</h1>

    <div class="bg-white border-4 border-black shadow-neo overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-neo-black text-white uppercase font-black">
                <tr>
                    <th class="p-4">ID</th>
                    <th class="p-4">Pelanggan</th>
                    <th class="p-4">Total</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $orders->fetch_assoc()): ?>
                <tr class="border-b-2 border-black hover:bg-gray-50 font-bold" id="row-<?= $row['id'] ?>">
                    <td class="p-4">#<?= $row['id'] ?></td>
                    <td class="p-4">
                        <div><?= $row['nama'] ?></div>
                        <div class="text-xs text-gray-500"><?= $row['email'] ?></div>
                    </td>
                    <td class="p-4">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                    <td class="p-4">
                        <?php 
                        $colors = [
                            'pending' => 'bg-yellow-200', 
                            'paid' => 'bg-blue-200', 
                            'shipped' => 'bg-purple-200', 
                            'completed' => 'bg-green-200', 
                            'cancelled' => 'bg-red-200'
                        ];
                        $bg = $colors[$row['status']] ?? 'bg-gray-200';
                        ?>
                        <span id="badge-<?= $row['id'] ?>" class="<?= $bg ?> border-2 border-black px-2 py-1 uppercase text-xs transition-colors duration-300">
                            <?= $row['status'] ?>
                        </span>
                    </td>
                    <td class="p-4 text-sm"><?= $row['tanggal_pesanan'] ?></td>
                    <td class="p-4">
                        <select onchange="updateStatus(<?= $row['id'] ?>, this.value)" class="border-2 border-black text-sm font-bold bg-white cursor-pointer px-2 py-1 focus:shadow-neo transition-all outline-none">
                            <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="paid" <?= $row['status'] == 'paid' ? 'selected' : '' ?>>Paid</option>
                            <option value="shipped" <?= $row['status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                            <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $row['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                        
                        <a href="detail.php?id=<?= $row['id'] ?>" class="inline-block ml-2 text-sm font-bold text-neo-black border-2 border-black bg-white px-2 py-1 text-center hover:bg-gray-100 hover:-translate-y-1 transition-transform">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Toast UI -->
<div id="toast-container" class="fixed bottom-4 right-4 z-[60] flex flex-col gap-2 pointer-events-none"></div>

<script>
async function updateStatus(orderId, newStatus) {
    const badge = document.getElementById(`badge-${orderId}`);
    const originalText = badge.innerText;
    
    // Optimistic Update (Visual feedback immediately)
    badge.innerText = 'Updating...';
    badge.className = 'bg-gray-200 border-2 border-black px-2 py-1 uppercase text-xs transition-colors duration-300';

    try {
        const response = await fetch('api_update_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                order_id: orderId,
                status: newStatus
            }),
        });

        const result = await response.json();

        if (result.success) {
            // Update Badge Color & Text based on server response
            badge.innerText = newStatus;
            badge.className = `${result.new_color} border-2 border-black px-2 py-1 uppercase text-xs transition-colors duration-300`;
            showToast(`Status Order #${orderId} berhasil diubah ke ${newStatus}`, 'success');
        } else {
            throw new Error(result.error || 'Gagal update');
        }
    } catch (error) {
        console.error('Error:', error);
        // Revert on failure
        badge.innerText = originalText;
        showToast('Gagal mengubah status pesanan', 'error');
    }
}

function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-green-400' : 'bg-red-500 text-white';
    
    toast.className = `${bgColor} border-4 border-black p-4 shadow-neo flex items-center gap-3 transform translate-y-full opacity-0 transition-all duration-300 pointer-events-auto min-w-[300px]`;
    toast.innerHTML = `
        <span class="text-2xl">${type === 'success' ? '✅' : '❌'}</span>
        <div class="font-bold uppercase">${message}</div>
    `;
    
    container.appendChild(toast);
    
    // Animate In
    requestAnimationFrame(() => {
        toast.classList.remove('translate-y-full', 'opacity-0');
    });

    // Auto Dismiss
    setTimeout(() => {
        toast.classList.add('opacity-0', 'translate-y-2');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

</body>
</html>
