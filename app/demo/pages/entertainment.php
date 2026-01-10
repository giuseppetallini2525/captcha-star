<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarBuzz - Movies, TV Shows, Celebrities & Entertainment News</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="modal.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f0f; color: #e5e5e5; }
        header { background: linear-gradient(180deg, #1a1a1a, #0f0f0f); padding: 1rem 2rem; }
        .nav-container { display: flex; justify-content: space-between; align-items: center; max-width: 1400px; margin: 0 auto; }
        .logo { font-size: 1.8rem; font-weight: 800; color: white; }
        .logo span { color: #fbbf24; }
        nav a { color: #888; text-decoration: none; margin-left: 2rem; font-weight: 500; }
        nav a:hover { color: #fbbf24; }
        .btn-login { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; padding: 0.6rem 1.5rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        .hero { background: linear-gradient(135deg, #1f1f1f, #2a2a2a); padding: 3rem 2rem; }
        .hero-content { max-width: 1200px; margin: 0 auto; }
        .hero-tag { background: #fbbf24; color: #000; display: inline-block; padding: 0.3rem 1rem; font-size: 0.75rem; font-weight: 700; border-radius: 4px; margin-bottom: 1rem; }
        .hero h1 { font-size: 2.5rem; margin-bottom: 1rem; color: white; }
        .hero p { color: #888; font-size: 1.1rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; }
        .section-title { font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 1.5rem; border-bottom: 3px solid #fbbf24; padding-bottom: 0.5rem; display: inline-block; }
        .article-card { background: #1a1a1a; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #2a2a2a; }
        .article-meta { color: #fbbf24; font-size: 0.8rem; font-weight: 600; margin-bottom: 0.5rem; }
        .article-title { font-size: 1.1rem; font-weight: 600; margin-bottom: 0.75rem; color: white; }
        .article-text { color: #888; font-size: 0.95rem; line-height: 1.8; }
        .sidebar-box { background: #1a1a1a; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid #2a2a2a; }
        .sidebar-title { font-size: 1rem; font-weight: 700; color: white; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #fbbf24; }
        .cta-box { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: #000; text-align: center; padding: 2rem; }
        .cta-btn { display: inline-block; background: #000; color: #fbbf24; padding: 0.75rem 2rem; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; }
        footer { background: #0a0a0a; padding: 2rem; text-align: center; margin-top: 3rem; }
        footer a { color: #fbbf24; }
        @media (max-width: 900px) { .content-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header>
        <div class="nav-container">
            <div class="logo">Star<span>Buzz</span></div>
            <nav>
                <a href="#">Movies</a>
                <a href="#">TV Shows</a>
                <a href="#">Celebrities</a>
                <a href="#">Streaming</a>
                <a href="#">Awards</a>
            </nav>
            <a href="#" onclick="openCaptchaModal(); return false;" class="btn-login">Accedi</a>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-tag">EXCLUSIVE</span>
            <h1>Marvel Studios Announces Phase 7 with New Avengers Film</h1>
            <p>The superhero franchise continues with exciting new characters and storylines</p>
        </div>
    </section>

    <div class="container">
        <div class="content-grid">
            <main>
                <h2 class="section-title">Entertainment News & Celebrity Updates</h2>

                <article class="article-card">
                    <div class="article-meta">MOVIES - SUPERHERO</div>
                    <h3 class="article-title">Spider-Man and Batman Lead Superhero Box Office Domination</h3>
                    <p class="article-text">
                        Superhero movies continue to dominate the global box office as Spider-Man and Batman films break attendance records. Marvel Studios and DC Comics are releasing ambitious slate of superhero films featuring beloved characters. Spider-Man's latest adventure has become one of the highest-grossing movies of all time, while Batman continues to captivate audiences with darker, more complex storytelling. Warner Bros. produces DC superhero films including Wonder Woman, Superman, and the Justice League franchise. The Avengers team, featuring Iron Man, Captain America, Thor, and Hulk, has generated billions in worldwide box office revenue. Superhero merchandise and comic book sales reflect the genre's massive popularity. Movie theaters benefit from the spectacle of superhero films designed for the big screen experience.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">STREAMING - PLATFORMS</div>
                    <h3 class="article-title">Netflix and Disney+ Battle for Streaming Supremacy</h3>
                    <p class="article-text">
                        The streaming wars intensify as Netflix and Disney+ compete for subscribers with exclusive content and major productions. Netflix continues to invest in original films and television series, while Disney+ leverages its Marvel, Star Wars, and Pixar franchises. Amazon Prime Video and HBO Max also compete aggressively in the streaming entertainment market. The Godfather-style prestige dramas and Game of Thrones fantasy epics set standards for premium television content. Streaming platforms are transforming how audiences consume movies and TV shows, challenging traditional theatrical releases. Entertainment companies are creating exclusive content to attract and retain streaming subscribers. The shift to digital platforms has created new opportunities for filmmakers and content creators worldwide.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">ANIMATION - STUDIOS</div>
                    <h3 class="article-title">Disney and Pixar Announce Exciting Animation Slate for 2026</h3>
                    <p class="article-text">
                        Disney Animation and Pixar have revealed their upcoming animated film slate, featuring sequels to beloved franchises and original stories. Frozen, Toy Story, and The Incredibles continue to captivate family audiences with memorable characters and heartwarming adventures. Mickey Mouse and other classic Disney characters remain cultural icons nearly a century after their creation. Pixar's innovative storytelling and cutting-edge animation technology set industry standards for quality entertainment. Disney+ provides streaming access to the studio's vast library of animated classics and new releases. The animation industry sees continued growth as audiences of all ages embrace animated storytelling. Theme parks featuring Disney and Pixar characters attract millions of visitors annually for immersive entertainment experiences.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">SCI-FI - FRANCHISES</div>
                    <h3 class="article-title">Star Wars and Transformers Expand Sci-Fi Universe with New Projects</h3>
                    <p class="article-text">
                        Science fiction franchises Star Wars and Transformers announce ambitious expansion plans with new films and television series. The Star Wars galaxy continues to grow with shows on Disney+ and theatrical releases exploring different eras of the beloved franchise. Transformers introduces new Autobot characters and storylines while honoring the franchise's action-packed legacy. Back to the Future remains a cherished classic that defined science fiction entertainment for generations. The Fast and Furious franchise combines action spectacle with automotive excitement for global audiences. Science fiction entertainment benefits from advances in visual effects technology that bring impossible worlds to life. Movie studios invest heavily in franchise properties that can generate films, merchandise, and theme park attractions.
                    </p>
                </article>

                <article class="article-card">
                    <div class="article-meta">COMICS - ADAPTATION</div>
                    <h3 class="article-title">Tom and Jerry, Snoopy: Classic Characters Find New Audiences</h3>
                    <p class="article-text">
                        Classic cartoon characters are experiencing a renaissance as studios develop new content for modern audiences. Tom and Jerry, the iconic cat and mouse duo, star in new animated series and theatrical releases. Snoopy and the Peanuts gang continue to charm viewers with timeless humor and heartfelt stories. Hello Kitty and Pikachu represent the influence of Japanese characters in global entertainment. Warner Bros. and other studios are mining their libraries of beloved characters for new entertainment opportunities. Barbie has successfully transitioned from toy to entertainment franchise with films and television content. Pokemon continues to be one of the most successful entertainment franchises, spanning games, animation, and merchandise. These characters connect generations of fans through shared entertainment experiences.
                    </p>
                </article>
            </main>

            <aside>
                <div class="sidebar-box cta-box">
                    <h3 style="margin-bottom: 0.75rem;">Join StarBuzz</h3>
                    <p style="opacity: 0.9; margin-bottom: 1rem;">Get exclusive entertainment news and celebrity updates</p>
                    <a href="#" onclick="openCaptchaModal(); return false;" class="cta-btn">Accedi</a>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Movie Studios</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.7;">
                        Disney, Pixar, Marvel Studios, Warner Bros., Universal Pictures, Paramount, Sony Pictures, 20th Century Studios, DreamWorks, Lionsgate, Netflix, Amazon Studios, movie production, film industry, Hollywood, cinema, blockbuster films, box office, theatrical releases, streaming content.
                    </p>
                </div>

                <div class="sidebar-box">
                    <h4 class="sidebar-title">Popular Characters</h4>
                    <p style="color: #888; font-size: 0.9rem; line-height: 1.7;">
                        Spider-Man, Batman, Superman, Wonder Woman, Iron Man, Captain America, Thor, Hulk, Mickey Mouse, Snoopy, Pikachu, Pokemon, Hello Kitty, Barbie, Star Wars, Transformers, Tom and Jerry, The Simpsons, superheroes, animated characters, comic book heroes, cartoon characters, entertainment franchises.
                    </p>
                </div>
            </aside>
        </div>
    </div>

    <footer>
        <p style="color: #666;">StarBuzz - Demo for <a href="../../index.php">CAPTCHaStar</a> | Sapienza University of Rome</p>
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
