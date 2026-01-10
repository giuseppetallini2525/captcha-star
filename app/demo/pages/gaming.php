<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVerse - Video Games News, Reviews & Esports Coverage</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f1a; color: #e0e0e0; }
        header { background: linear-gradient(180deg, #1a1a2e, #16162a); padding: 1rem 2rem; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; }
        .logo { font-size: 1.8rem; font-weight: 800; color: white; }
        .logo span { color: #7c3aed; }
        nav a { color: #888; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: #7c3aed; }
        .btn-login { background: #7c3aed; color: white; padding: 0.6rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { padding: 2rem; max-width: 1400px; margin: 0 auto; }
        .hero-main { background: linear-gradient(135deg, #2a1f5c, #1a1a2e); border-radius: 12px; padding: 3rem; margin-bottom: 2rem; }
        .hero-main h1 { font-size: 2rem; color: white; margin-bottom: 1rem; }
        .hero-main p { color: #aaa; font-size: 1.1rem; }
        .game-tag { display: inline-block; background: #7c3aed; padding: 0.25rem 0.75rem; border-radius: 4px; font-size: 0.75rem; font-weight: 600; margin-bottom: 1rem; }
        .container { max-width: 1400px; margin: 0 auto; padding: 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 1.5rem; border-bottom: 2px solid #7c3aed; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: #1a1a2e; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .article-meta { color: #7c3aed; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { color: white; font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; }
        .article-text { color: #999; font-size: 0.95rem; line-height: 1.7; }
        .sidebar-box { background: #1a1a2e; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: white; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #7c3aed; }
        .cta-box { background: linear-gradient(135deg, #7c3aed, #4c1d95); text-align: center; padding: 2rem; }
        .cta-box h3 { color: white; margin-bottom: 0.75rem; }
        .cta-box p { color: rgba(255,255,255,0.8); margin-bottom: 1rem; }
        .cta-btn { display: inline-block; background: white; color: #7c3aed; padding: 0.75rem 2rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #0a0a14; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #7c3aed; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } nav { display: none; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Game<span>Verse</span></div>
            <nav>
                <a href="#">News</a>
                <a href="#">Reviews</a>
                <a href="#">PlayStation</a>
                <a href="#">Xbox</a>
                <a href="#">Nintendo</a>
                <a href="#">PC Gaming</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-main">
            <span class="game-tag">EXCLUSIVE NEWS</span>
            <h1>GTA VI Release Date Confirmed: Rockstar Announces Fall 2025 Launch for PlayStation and Xbox</h1>
            <p>The most anticipated video game of the decade is finally coming. Pre-orders open next month for console gaming fans.</p>
        </div>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Gaming News & Video Game Reviews</h2>

                <article class="article-card">
                    <div class="article-meta">PLAYSTATION 5 - EXCLUSIVE</div>
                    <h3 class="article-title">Spider-Man 3 Announced: Insomniac Games Reveals Next PlayStation Exclusive</h3>
                    <p class="article-text">
                        Sony Interactive Entertainment and Insomniac Games have officially announced Spider-Man 3, the next installment in the critically acclaimed PlayStation exclusive franchise. The video game will be available exclusively on PlayStation 5 console, showcasing the full power of the next-generation gaming hardware. The game features an expanded open world of New York City with new villains and gameplay mechanics. PlayStation gamers can expect the same high-quality action-adventure experience that made previous Spider-Man games bestsellers. The announcement came during a PlayStation State of Play broadcast, where developers demonstrated new web-swinging mechanics and combat systems. Gaming journalists praised the stunning graphics and smooth performance running on the PS5 console.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">XBOX - GAME PASS</div>
                    <h3 class="article-title">Xbox Game Pass Adds 20 New Titles Including Day-One Releases</h3>
                    <p class="article-text">
                        Microsoft has announced a massive update to Xbox Game Pass, adding twenty new video games to the subscription service including several day-one releases. The gaming subscription now includes popular titles across multiple genres from action-adventure to role-playing games and first-person shooters. Xbox console owners can download and play these games immediately with their Game Pass subscription. Microsoft gaming executives emphasized their commitment to providing value for gamers through the subscription model. The additions include both AAA blockbusters and indie gaming gems, catering to all types of video game enthusiasts. PC gaming fans can also access many of these titles through Game Pass Ultimate subscription.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">NINTENDO - SWITCH 2</div>
                    <h3 class="article-title">Nintendo Direct Reveals Switch 2 Launch Lineup with Zelda and Mario Games</h3>
                    <p class="article-text">
                        Nintendo has unveiled the complete launch lineup for the upcoming Nintendo Switch 2 console, featuring new entries in beloved franchises including The Legend of Zelda and Super Mario. The video game showcase highlighted improved graphics and performance capabilities of the new gaming hardware. Nintendo fans can expect backward compatibility with existing Switch games plus exclusive new titles designed for the upgraded console. The Legend of Zelda: Echoes will be a launch title, showcasing the enhanced gaming capabilities of the Switch 2. Super Mario developer teams are also preparing a new 3D platformer for the console launch. The Nintendo Direct presentation generated massive excitement among gaming communities worldwide.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">ESPORTS - COMPETITIVE GAMING</div>
                    <h3 class="article-title">Fortnite World Cup Returns with Record Prize Pool for Esports Tournament</h3>
                    <p class="article-text">
                        Epic Games has announced the return of the Fortnite World Cup with the largest prize pool in esports history. The competitive gaming tournament will feature players from around the world competing in the popular battle royale video game. Fortnite continues to dominate the gaming landscape with millions of active players across console and PC platforms. The esports event will be broadcast live on Twitch and YouTube Gaming, reaching millions of streaming viewers. Professional gamers and content creators are already preparing for the competition through intense gaming sessions and practice matches. The tournament represents the growing legitimacy of competitive video gaming as a spectator sport.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">PC GAMING - HARDWARE</div>
                    <h3 class="article-title">NVIDIA Announces Next-Generation Graphics Cards for Ultimate Gaming Performance</h3>
                    <p class="article-text">
                        NVIDIA has revealed its next-generation RTX 50 series graphics cards, promising unprecedented performance for PC gaming enthusiasts. The new GPU lineup offers ray tracing capabilities and AI-powered upscaling for stunning visual fidelity in video games. PC gamers can expect significant performance improvements in popular titles like Cyberpunk, Call of Duty, and Minecraft with RTX features enabled. The graphics cards support 8K gaming and virtual reality applications, pushing the boundaries of immersive gaming experiences. Gaming PC builders are excited about the new hardware options for creating powerful gaming rigs. The announcement positions NVIDIA as the leader in gaming graphics technology for years to come.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3>Join GameVerse</h3>
                    <p>Get personalized gaming news and connect with players</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Gaming Platforms</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.6;">
                        PlayStation 5, Xbox Series X, Nintendo Switch, PC gaming, Steam, Epic Games Store, gaming consoles, handheld gaming devices, virtual reality headsets, gaming controllers, gaming headsets, mechanical keyboards, gaming monitors, graphics cards, gaming laptops, cloud gaming services, mobile gaming, esports tournaments, competitive gaming, streaming platforms, Twitch, YouTube Gaming.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Popular Games</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.6;">
                        Fortnite, Minecraft, Call of Duty, Grand Theft Auto, The Legend of Zelda, Super Mario, Pokemon, FIFA, NBA 2K, Madden NFL, Assassin's Creed, Spider-Man, God of War, Halo, Gears of War, Final Fantasy, Resident Evil, The Witcher, Cyberpunk, Elden Ring, Overwatch, League of Legends, Valorant, Counter-Strike, Apex Legends, Destiny, World of Warcraft, Diablo.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p style="color: #666;">GameVerse - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
    </footer>

<!-- CAPTCHA Modal -->
<div id="captchaModal" class="captcha-modal-overlay" onclick="closeCaptchaModal(event)">
    <div class="captcha-modal" onclick="event.stopPropagation()">
        <div class="captcha-modal-header">
            <h3>Sponsored CAPTCHA</h3>
            <button class="captcha-modal-close" onclick="closeCaptchaModal()">&times;</button>
        </div>
        <div class="captcha-modal-body">
            <iframe id="captchaFrame" src=""></iframe>
        </div>
    </div>
</div>

<script>
    function openCaptchaModal() {
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        var currentUrl = window.location.href;
        iframe.src = 'captcha-modal.php?from=' + encodeURIComponent(currentUrl);
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeCaptchaModal(event) {
        if (event && event.target !== event.currentTarget) return;
        var modal = document.getElementById('captchaModal');
        var iframe = document.getElementById('captchaFrame');
        modal.classList.remove('active');
        iframe.src = '';
        document.body.style.overflow = '';
    }

    window.addEventListener('message', function(event) {
        if (event.data && event.data.type === 'captcha-success') {
            console.log('CAPTCHA solved successfully!');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCaptchaModal();
        }
    });
</script>
</body>
</html>
