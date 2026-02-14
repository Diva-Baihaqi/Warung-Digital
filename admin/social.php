<?php
include '../config/database.php';
checkAdmin();
include 'includes/header.php';
include 'includes/sidebar.php';

// A generic function to render a table for simple social data
function renderSocialTable($title, $conn, $table) {
    echo "<div class='mb-12'>";
    echo "<h2 class='text-2xl font-black uppercase mb-4'>Data $title</h2>";
    echo "<div class='bg-white border-4 border-black shadow-neo overflow-hidden max-h-64 overflow-y-auto'>";
    echo "<table class='w-full text-left'><thead class='bg-neo-black text-white px-2 sticky top-0'><tr><th class='p-2'>ID</th><th class='p-2'>Data</th><th class='p-2'>Aksi</th></tr></thead><tbody>";
    
    // In a real app we'd join tables, but for this 'CRUD' demo we just show raw data
    $res = $conn->query("SELECT * FROM $table LIMIT 10");
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()) {
            echo "<tr class='border-b-2 border-black'><td class='p-2'>{$row['id']}</td><td class='p-2'>Raw Data: ".json_encode($row)."</td>";
            echo "<td class='p-2'><a href='?del_table=$table&id={$row['id']}' class='text-red-500 font-bold'>Hapus</a></td></tr>";
        }
    } else {
        echo "<tr><td colspan='3' class='p-4 text-center font-bold'>Kosong</td></tr>";
    }
    
    echo "</tbody></table></div></div>";
}

if(isset($_GET['del_table']) && isset($_GET['id'])) {
    $tbl = $_GET['del_table'];
    $id = $_GET['id'];
    // Very basic security check to allow only specific tables
    if(in_array($tbl, ['social_likes', 'social_follows', 'social_shares'])) {
        $conn->query("DELETE FROM $tbl WHERE id = $id");
    }
    echo "<script>window.location='social.php';</script>";
}
?>

<div class="flex-1 p-8 relative">
    <!-- Background grid decoration -->
    <div class="absolute inset-0 pattern-grid-lg opacity-10 pointer-events-none z-0"></div>

    <div class="relative z-10">
        <h1 class="text-5xl font-black uppercase tracking-tighter mb-2">Social Hub</h1>
        <p class="font-bold text-gray-500 text-lg border-l-4 border-neo-accent pl-3 mb-10">Pantau interaksi sosial warungmu secara realtime.</p>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Likes -->
            <?php 
            $count_likes = $conn->query("SELECT COUNT(*) as c FROM social_likes")->fetch_assoc()['c'];
            ?>
            <div class="bg-red-400 border-4 border-black p-6 shadow-neo transform hover:-translate-y-2 transition-transform flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <h2 class="text-2xl font-black uppercase text-white">Total Likes</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                </div>
                <div class="text-6xl font-black text-white stroke-black"><?= number_format($count_likes) ?></div>
            </div>

            <!-- Follows -->
            <?php 
            $count_follows = $conn->query("SELECT COUNT(*) as c FROM social_follows")->fetch_assoc()['c'];
            ?>
            <div class="bg-blue-400 border-4 border-black p-6 shadow-neo transform hover:-translate-y-2 transition-transform flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <h2 class="text-2xl font-black uppercase text-white">Total Follows</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>
                </div>
                <div class="text-6xl font-black text-white"><?= number_format($count_follows) ?></div>
            </div>

            <!-- Shares -->
            <?php 
            $count_shares = $conn->query("SELECT COUNT(*) as c FROM social_shares")->fetch_assoc()['c'];
            ?>
            <div class="bg-yellow-400 border-4 border-black p-6 shadow-neo transform hover:-translate-y-2 transition-transform flex flex-col justify-between h-40">
                <div class="flex justify-between items-start">
                    <h2 class="text-2xl font-black uppercase text-black">Total Shares</h2>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-black" viewBox="0 0 20 20" fill="currentColor"><path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" /></svg>
                </div>
                <div class="text-6xl font-black text-black"><?= number_format($count_shares) ?></div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Activity Feed (Mixed) -->
            <div class="bg-white border-4 border-black shadow-neo p-6 lg:col-span-2">
                <h3 class="text-2xl font-black uppercase mb-6 flex items-center gap-2">
                    <span class="bg-black text-white px-2 py-1">LIVE</span> Recent Activity
                </h3>
                
                <div class="space-y-4">
                    <?php
                    // Fetch recent likes
                    $likes = $conn->query("SELECT 'like' as type, created_at, user_id, target_type as info FROM social_likes ORDER BY created_at DESC LIMIT 5");
                    // Fetch recent follows
                    $follows = $conn->query("SELECT 'follow' as type, created_at, follower_id as user_id, following_id as info FROM social_follows ORDER BY created_at DESC LIMIT 5");
                    // Fetch recent shares
                    $shares = $conn->query("SELECT 'share' as type, created_at, user_id, platform as info FROM social_shares ORDER BY created_at DESC LIMIT 5");
                    
                    // Merge (simple array merge for display, logic could be optimized)
                    $activities = [];
                    while($row = $likes->fetch_assoc()) $activities[] = $row;
                    while($row = $follows->fetch_assoc()) $activities[] = $row;
                    while($row = $shares->fetch_assoc()) $activities[] = $row;
                    
                    // Sort by time
                    usort($activities, function($a, $b) {
                        return strtotime($b['created_at']) - strtotime($a['created_at']);
                    });
                    
                    // Slice top 8
                    $activities = array_slice($activities, 0, 8);
                    
                    foreach($activities as $act):
                        $iconClass = '';
                        $bgClass = '';
                        $text = '';
                        
                        if($act['type'] == 'like') {
                            $bgClass = 'bg-red-100 border-red-500';
                            $text = "User #{$act['user_id']} <strong>LIKED</strong> item {$act['info']}";
                        } elseif($act['type'] == 'follow') {
                            $bgClass = 'bg-blue-100 border-blue-500';
                            $text = "User #{$act['user_id']} <strong>FOLLOWED</strong> user #{$act['info']}";
                        } else {
                            $bgClass = 'bg-yellow-100 border-yellow-500';
                            $text = "User #{$act['user_id']} <strong>SHARED</strong> on {$act['info']}";
                        }
                    ?>
                    <div class="flex items-center gap-4 p-4 border-2 border-black bg-white hover:bg-gray-50 transition-colors">
                        <div class="w-12 h-12 flex items-center justify-center border-2 border-black font-black bg-gray-200">
                           <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $act['user_id'] ?>" alt="Av" class="w-full h-full">
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-800 text-lg uppercase"><?= $act['type'] ?></p>
                            <p class="text-sm text-gray-600"><?= $text ?></p>
                        </div>
                        <div class="text-xs font-bold text-gray-400 bg-black text-white px-2 py-1">
                            <?= date('H:i', strtotime($act['created_at'])) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                    <?php if(empty($activities)): ?>
                        <div class="p-4 text-center font-bold text-gray-500 italic">Belum ada aktivitas.</div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Quick Actions -->
             <div class="bg-neo-black text-white border-4 border-black shadow-neo p-6 hidden"> <!-- Hidden for now, maybe add settings later -->
                <h3 class="text-xl font-black uppercase mb-4 text-neo-secondary">Settings</h3>
             </div>
        </div>
    </div>
</div>
</body>
</html>
