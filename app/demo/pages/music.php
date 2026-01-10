<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicHub - Rock, Metal, Pop & Concert News</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0a; color: #e0e0e0; }
        header { background: linear-gradient(180deg, #1a1a1a, #0f0f0f); padding: 1rem 2rem; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; }
        .logo { font-size: 1.8rem; font-weight: 800; color: white; }
        .logo span { color: #10b981; }
        nav a { color: #888; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        .btn-login { background: #10b981; color: white; padding: 0.6rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #1a1a1a, #2a2a2a); padding: 4rem 2rem; text-align: center; }
        .hero h1 { font-size: 2.5rem; color: white; margin-bottom: 1rem; }
        .hero p { color: #aaa; font-size: 1.2rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 1.5rem; border-bottom: 2px solid #10b981; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: #1a1a1a; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .article-meta { color: #10b981; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { color: white; font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; }
        .article-text { color: #999; font-size: 0.95rem; line-height: 1.7; }
        .sidebar-box { background: #1a1a1a; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: white; margin-bottom: 1rem; border-bottom: 2px solid #10b981; padding-bottom: 0.5rem; }
        .cta-box { background: linear-gradient(135deg, #10b981, #059669); text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: white; color: #10b981; padding: 0.75rem 2rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #050505; padding: 2rem; text-align: center; margin-top: 3rem; color: #666; }
        footer a { color: #10b981; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Music<span>Hub</span></div>
            <nav>
                <a href="#">Rock</a>
                <a href="#">Metal</a>
                <a href="#">Pop</a>
                <a href="#">Hip Hop</a>
                <a href="#">Concerts</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <h1>Your Source for Music News & Concert Updates</h1>
        <p>Rock, metal, pop, hip hop - all the music you love in one place</p>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Music News & Concert Updates</h2>

                <article class="article-card">
                    <div class="article-meta">ROCK MUSIC - TOUR</div>
                    <h3 class="article-title">Legendary Rock Band Announces Massive World Tour for 2026</h3>
                    <p class="article-text">
                        One of rock music's most iconic bands has announced an extensive world tour spanning multiple continents throughout 2026. The legendary rock group will perform at major concert venues and music festivals across Europe, North America, and Asia. Fans can expect a setlist featuring classic rock songs alongside new material from their upcoming studio album. The rock band's guitar solos and powerful drum beats have influenced generations of musicians since their formation in the 1970s. Concert tickets are expected to sell out quickly as rock music enthusiasts rush to secure their spots. The tour will feature state-of-the-art stage production with immersive lighting and sound systems designed for stadium concerts.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">HEAVY METAL - NEW ALBUM</div>
                    <h3 class="article-title">Metal Giants Release Highly Anticipated New Album After Five-Year Hiatus</h3>
                    <p class="article-text">
                        Heavy metal fans worldwide are celebrating the release of a new album from one of the genre's most influential bands. The metal band's latest record features crushing guitar riffs, thunderous drums, and powerful vocals that showcase their evolution while staying true to their heavy metal roots. Recording sessions took place at legendary music studios with renowned rock and metal producers. The album debuted at number one on multiple music charts, demonstrating the enduring popularity of heavy metal music. Critics praise the band's songwriting and the album's production quality, comparing it favorably to their classic metal releases. A massive concert tour is planned to support the new record.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">MUSIC FESTIVAL - SUMMER 2026</div>
                    <h3 class="article-title">Major Music Festival Announces Star-Studded Lineup for Summer 2026</h3>
                    <p class="article-text">
                        Festival organizers have revealed an incredible lineup for the upcoming summer music festival, featuring headliners from rock, pop, hip hop, and electronic music genres. The three-day concert event will host over one hundred musical artists across multiple stages. Rock bands, metal groups, pop stars, and hip hop artists will perform for thousands of music fans. The festival has become one of the most anticipated music events of the year, attracting concert-goers from around the world. Live music performances will run from afternoon until late night, with special guest appearances and collaborations expected. Festival camping and premium viewing packages are now available for music enthusiasts.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">SPOTIFY - STREAMING</div>
                    <h3 class="article-title">Music Streaming Platform Reports Record Growth in Rock and Metal Genres</h3>
                    <p class="article-text">
                        Leading music streaming service Spotify has reported significant growth in rock and metal music streaming, with classic rock bands seeing increased listener numbers. The platform's data reveals that guitar-driven music continues to attract new generations of listeners alongside dedicated longtime fans. Rock music playlists have become some of the most followed collections on the streaming service. Metal bands are also experiencing a streaming renaissance as younger audiences discover heavy music through algorithm recommendations. The music industry is taking note of these trends, with record labels investing more in rock and metal artist development. Streaming has become the primary way music fans discover and enjoy their favorite songs and albums.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="color: white; margin-bottom: 0.75rem;">Join MusicHub</h3>
                    <p style="color: rgba(255,255,255,0.9); margin-bottom: 1rem;">Get concert alerts and exclusive music content</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Music Genres</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.6;">
                        Rock music, heavy metal, hard rock, classic rock, alternative rock, punk rock, progressive rock, pop music, hip hop, rap, electronic music, jazz, blues, country music, folk music, indie rock, grunge, thrash metal, death metal, black metal, power metal, symphonic metal, concert music, live performances.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Legendary Bands</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.6;">
                        The Beatles, Led Zeppelin, Pink Floyd, Queen, The Rolling Stones, AC/DC, Metallica, Iron Maiden, Black Sabbath, Guns N' Roses, Nirvana, Pearl Jam, Foo Fighters, Red Hot Chili Peppers, U2, Coldplay, Radiohead, Oasis, The Who, Deep Purple, Rush, Van Halen, Aerosmith, Kiss, Slayer, Megadeth, Slipknot, Rammstein.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p>MusicHub - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
