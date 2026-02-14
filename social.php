<?php
include 'config/database.php';
include 'includes/public_header.php';

// Stats Queries
$count_likes = $conn->query("SELECT COUNT(*) as c FROM social_likes")->fetch_assoc()['c'];
$count_follows = $conn->query("SELECT COUNT(*) as c FROM social_follows")->fetch_assoc()['c'];
$count_shares = $conn->query("SELECT COUNT(*) as c FROM social_shares")->fetch_assoc()['c'];

// Recent Activity Query
$likes = $conn->query("SELECT 'like' as type, created_at, user_id, target_type as info FROM social_likes ORDER BY created_at DESC LIMIT 5");
$follows = $conn->query("SELECT 'follow' as type, created_at, follower_id as user_id, following_id as info FROM social_follows ORDER BY created_at DESC LIMIT 5");
$shares = $conn->query("SELECT 'share' as type, created_at, user_id, platform as info FROM social_shares ORDER BY created_at DESC LIMIT 5");

$activities = [];
while($row = $likes->fetch_assoc()) $activities[] = $row;
while($row = $follows->fetch_assoc()) $activities[] = $row;
while($row = $shares->fetch_assoc()) $activities[] = $row;

usort($activities, function($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});
$activities = array_slice($activities, 0, 10);
?>

<div class="container mx-auto px-4 py-12">
    <div class="text-center mb-16">
        <h1 class="text-5xl md:text-7xl font-black uppercase mb-4 leading-none tracking-tighter">
            Social <span class="text-neo-accent">Hub</span>
        </h1>
        <p class="text-xl font-bold max-w-2xl mx-auto border-b-4 border-black pb-4 inline-block">
            Pantau interaksi komunitas Warung Digital secara realtime.
        </p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <!-- Likes -->
        <div class="bg-red-400 border-4 border-black p-8 shadow-neo-lg transform rotate-1 hover:rotate-0 hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
            <h2 class="text-3xl font-black uppercase text-white mb-2">Total Likes</h2>
            <div class="flex justify-between items-end">
                <span class="text-7xl font-black text-white stroke-black"><?= number_format($count_likes) ?></span>
                <span class="text-4xl">❤️</span>
            </div>
        </div>

        <!-- Follows -->
        <div class="bg-blue-400 border-4 border-black p-8 shadow-neo-lg transform -rotate-1 hover:rotate-0 hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
            <h2 class="text-3xl font-black uppercase text-white mb-2">Total Follows</h2>
            <div class="flex justify-between items-end">
                 <span class="text-7xl font-black text-white stroke-black"><?= number_format($count_follows) ?></span>
                 <span class="text-4xl">👥</span>
            </div>
        </div>

        <!-- Shares -->
        <div class="bg-yellow-400 border-4 border-black p-8 shadow-neo-lg transform rotate-2 hover:rotate-0 hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all">
            <h2 class="text-3xl font-black uppercase text-black mb-2">Total Shares</h2>
             <div class="flex justify-between items-end">
                <span class="text-7xl font-black text-black stroke-white"><?= number_format($count_shares) ?></span>
                <span class="text-4xl">📢</span>
             </div>
        </div>
    </div>

    <!-- Live Feed -->
    <div class="max-w-4xl mx-auto relative">
        <div class="absolute -left-4 top-0 w-1 h-full bg-black"></div>
        
        <h3 class="text-3xl font-black uppercase mb-8 ml-8 bg-black text-white inline-block px-4 py-2 transform -skew-x-12">Live Activity Feed</h3>

        <div class="space-y-6 ml-8">
            <?php foreach($activities as $act): 
                $bg = $act['type'] == 'like' ? 'bg-red-50' : ($act['type'] == 'follow' ? 'bg-blue-50' : 'bg-yellow-50');
                $border = $act['type'] == 'like' ? 'border-red-500' : ($act['type'] == 'follow' ? 'border-blue-500' : 'border-yellow-500');
                $emoji = $act['type'] == 'like' ? '❤️' : ($act['type'] == 'follow' ? '👣' : '📣');
                
                $text = '';
                if($act['type'] == 'like') $text = "menyukai produk #{$act['info']}";
                elseif($act['type'] == 'follow') $text = "mulai mengikuti user #{$act['info']}";
                else $text = "membagikan konten ke {$act['info']}";
            ?>
            <div class="relative bg-white border-4 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all flex items-center gap-4">
                <!-- Connector Line Node -->
                <div class="absolute -left-[44px] top-1/2 w-8 h-1 bg-black"></div>
                <div class="absolute -left-[54px] top-1/2 w-4 h-4 bg-black rounded-full transform -translate-y-1/2 border-2 border-white"></div>

                <div class="w-12 h-12 flex-shrink-0 bg-gray-200 border-2 border-black rounded-full overflow-hidden">
                     <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=<?= $act['user_id'] ?>" alt="Av">
                </div>
                
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center gap-1 md:gap-2">
                        <span class="font-black uppercase text-lg">User #<?= $act['user_id'] ?></span>
                        <span class="text-gray-600 font-bold text-sm bg-gray-100 px-2 py-0.5 border border-black inline-block rounded-full">
                            <?= date('H:i • d M', strtotime($act['created_at'])) ?>
                        </span>
                    </div>
                    <p class="font-bold text-gray-800">
                        <span class="text-2xl mr-2"><?= $emoji ?></span> <?= $text ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
