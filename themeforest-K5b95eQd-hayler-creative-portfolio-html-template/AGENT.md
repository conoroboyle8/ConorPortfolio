# Hayler Agent

This file gives you everything you need to work on the Hayler HTML template correctly. Read it fully before making any changes.

---

## How to use this file

Attach this file to your Claude conversation along with the HTML file(s) you want to modify. Tell Claude what you need — "add a new project page", "create a services section", "change the hero to a video background" — and Claude will apply changes using the exact classes, structure, and conventions documented here.

---

## What Hayler is

Static HTML template. No WordPress, no CMS, no build process, no Node.js. All files are plain HTML, CSS, and JavaScript. Open `index.html` in a browser and the site works.

**Technologies:** HTML5, CSS3, Vanilla JavaScript, PHP (contact form only)
**Libraries (all local in `lib/`):** GSAP 3.13.0, Lenis 1.3.18, Three.js r128
**Icons:** Font Awesome 6.7.2 (local in `css/` and `webfonts/`)
**Fonts:** Inter Tight, Funnel Display (local in `webfonts/`)

---

## File structure

```
hayler/
  css/
    variables.css       ← EDIT: colors, fonts, spacing tokens
    custom.css          ← EDIT: all custom styles go here
    preloader.css       ← EDIT: preloader animation styles
    style.css           ← DO NOT EDIT: main entry point
    content.css         ← DO NOT EDIT: core framework
    showcase.css        ← DO NOT EDIT: core framework
    portfolio.css       ← DO NOT EDIT: core framework
    shortcodes.css      ← DO NOT EDIT: core framework
    all.min.css         ← DO NOT EDIT: Font Awesome
  js/
    scripts.js          ← EDIT: initialization and custom functions
    preloader.js        ← EDIT: preloader animation logic
    common.js           ← DO NOT EDIT: core framework
    slider.js           ← DO NOT EDIT: slider engine
  lib/
    gsap.js             ← DO NOT EDIT
    lenis.js            ← DO NOT EDIT
    three.js            ← DO NOT EDIT
  images/
    projects/           ← project images: 01project1.jpg pattern
    displacement/       ← DO NOT TOUCH: WebGL maps for Three.js slider
    logo.png            ← dark logo (used on light pages)
    logo-white.png      ← white logo (used on dark pages)
  webfonts/             ← DO NOT RENAME OR MOVE
  style.css             ← DO NOT EDIT
  index.html
  about.html
  contact.html
  terms.html
  404.html
  portfolio-grid.html
  portfolio-carousel.html
  portfolio-lists.html
  project01.html → project08.html
  contact.php           ← EDIT: change $address only
  favicon.ico
```

**Rules:**
- All custom CSS → `css/custom.css`
- All custom JS → `js/scripts.js`
- New images → `images/` or `images/projects/`
- Never create new folders at the project root
- Never edit `common.js`, `slider.js`, `style.css`, or any file in `lib/`

---

## Script loading order

Every HTML file loads scripts in this exact order before `</body>`. Never change the order.

```html
<script src="lib/gsap.js"></script>
<script src="lib/lenis.js"></script>
<script src="lib/three.js"></script>
<script src="js/preloader.js"></script>
<script src="js/slider.js"></script>
<script src="js/common.js"></script>
<script src="js/scripts.js"></script>
```

---

## CSS loading order

In `<head>`, in this order:

```html
<!-- Critical — loaded immediately -->
<link href="style.css" rel="stylesheet">
<link href="css/variables.css" rel="stylesheet">
<link href="css/preloader.css" rel="stylesheet">

<!-- Non-critical — async preload -->
<link href="css/content.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/content.css" rel="stylesheet"></noscript>
<link href="css/showcase.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/showcase.css" rel="stylesheet"></noscript>
<link href="css/portfolio.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/portfolio.css" rel="stylesheet"></noscript>
<link href="css/shortcodes.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/shortcodes.css" rel="stylesheet"></noscript>
<link href="css/custom.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/custom.css" rel="stylesheet"></noscript>
<link href="css/all.min.css" rel="preload" as="style" onload="this.rel='stylesheet'">
<noscript><link href="css/all.min.css" rel="stylesheet"></noscript>
```

---

## Complete page anatomy

Every HTML page follows this exact structure from `<body>` to `</body>`:

```html
<body class="hidden hidden-ball enable-lenis hayler">

  <!-- Preloader -->
  <div id="clapat-preloader" class="preloader-wrap">
    <div class="preloader-reveal">
      <span></span><span></span><span></span><span></span>
    </div>
    <div class="preloader-caption">
      <div class="preloader-info">
        <span>Page is Loading<span class="dots"></span></span>
      </div>
      <div class="preloader-percentage">
        <div class="percentage">
          <span class="number number_1"><span>0</span><span>1</span></span>
          <span class="number number_2"><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>0</span></span>
          <span class="number number_3"><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span><span>0</span></span>
        </div>
      </div>
    </div>
  </div>

  <main>
    <div class="clapat-index">
      <div id="clapat-page-content" class="dark-content" data-bgcolor="#f7f7f7">

        <!-- Header goes here -->
        <!-- Content Scroll goes here -->

      </div>
    </div>
  </main>

  <!-- Cursor -->
  <div id="clapat-cursor" data-cursor-zoom="fa fa-plus" data-cursor-play="fa fa-play" data-cursor-pause="fa fa-pause" data-cursor-drag-x="Drag" data-cursor-drag-y="fa-solid fa-arrows-up-down" data-cursor-prev="fa fa-arrow-left" data-cursor-next="fa fa-arrow-right">
    <div id="ball">
      <div id="ball-loader"></div>
    </div>
  </div>

  <div class="clapat-rotate-device"></div>

  <!-- Scripts in order -->
</body>
```

---

## Page options

### Body classes (required)
```
hidden          ← always present, controls initial page reveal
hidden-ball     ← always present, controls cursor initial state
enable-lenis    ← enables smooth scroll; remove to use native scroll
hayler          ← template identifier, used for CSS scoping
disable-preloader ← optional; skips preloader, calls onPreloaderComplete immediately
```

### `#clapat-page-content` attributes

```html
<!-- Light page (dark background) -->
<div id="clapat-page-content" class="light-content" data-bgcolor="#0c0c0c">

<!-- Dark page (light background) -->
<div id="clapat-page-content" class="dark-content" data-bgcolor="#f7f7f7">
```

- `light-content` → white logo, white nav text, white header elements
- `dark-content` → black logo, black nav text, black header elements
- `data-bgcolor` → sets the initial page background color; also used by AJAX transitions for the transition cover color

### Cursor options

Add to `#clapat-cursor` to disable the custom cursor globally:
```html
<div id="clapat-cursor" class="disable-cursor" ...>
```

---

## Header structure

```html
<header id="clapat-header" class="classic-menu">

  <div id="header-gradient"></div>

  <div id="header-container">

    <!-- Logo -->
    <div id="clapat-logo" data-ball="hide">
      <a class="ajax-link" data-type="page-transition" href="index.html">
        <img class="black-logo" src="images/logo.png" alt="Studio Name">
        <img class="white-logo" src="images/logo-white.png" alt="Studio Name">
      </a>
    </div>

    <!-- Navigation -->
    <nav id="clapat-nav-wrapper">
      <div class="nav-height">
        <ul class="clapat-nav">

          <!-- Simple link -->
          <li class="menu-timeline" data-ball="highlight">
            <a class="ajax-link" data-type="page-transition" href="about.html">
              <div class="before-span"><span data-hover="Studio">Studio</span></div>
            </a>
          </li>

          <!-- Link with dropdown -->
          <li class="menu-timeline" data-ball="highlight">
            <a class="ajax-link" data-type="page-transition" href="#">
              <div class="before-span"><span data-hover="Works">Works</span></div>
            </a>
            <ul>
              <li><a class="ajax-link" href="portfolio-carousel.html" data-type="page-transition">Case Studies</a></li>
              <li><a class="ajax-link" href="portfolio-grid.html" data-type="page-transition">Portfolio</a></li>
            </ul>
          </li>

          <!-- Active link (current page) -->
          <li class="menu-timeline" data-ball="highlight">
            <a class="ajax-link active" data-type="page-transition" href="index.html">
              <div class="before-span"><span data-hover="Index">Index</span></div>
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <!-- Burger button -->
    <div id="burger-button" class="button-wrap button-link right circle-edge burger-dots" data-sticky>
      <div class="icon-wrap">
        <div class="icon-effects parallax-wrap" data-ball-size="grow" data-ball-color="primary">
          <div class="button-icon parallax-element">
            <i class="burger-icon"><span></span><span></span><span></span></i>
          </div>
        </div>
      </div>
      <div class="text-wrap">
        <div class="button-text"><span data-hover="Menu">Menu</span></div>
      </div>
    </div>

    <!-- Optional header button (appended to nav) -->
    <div id="header-buttons-wrapper" class="append-to-nav">
      <div id="header-button" class="button-wrap button-icon-box outline-solid reveal-icon right circle-edge header-element-color" data-sticky>
        <a class="ajax-link" data-type="page-transition" href="contact.html">
          <div class="icon-wrap">
            <div class="icon-effects parallax-wrap">
              <div class="button-icon parallax-element">
                <i class="fa-solid fa-arrow-right"></i>
              </div>
            </div>
          </div>
          <div class="text-wrap">
            <div class="button-text"><span data-hover="Get Started">Get Started</span></div>
          </div>
        </a>
      </div>
    </div>

  </div>
</header>
```

**Header behavior classes** (add to `<header>`):
- `classic-menu` → standard horizontal nav
- `change-header-color` → header inverts color when scrolling over a dark/light section boundary
- `invert-header` → permanently inverted header color
- `disable-header-gradient` → disables the gradient overlay behind the header

**Section-level header control** (add to `<section>`):
- `change-header-color` → triggers header color change when this section reaches the header
- `disable-header-gradient` → disables header gradient specifically over this section

---

## Content scroll wrapper

Everything between the header and `</div><!--/Page Content-->` lives inside:

```html
<div id="content-scroll">

  <!-- Hero section -->
  <div id="hero"> ... </div>

  <!-- Main content -->
  <div id="main-content">
    <div id="main-page-content">
      <!-- content rows go here -->
    </div>

    <!-- Page nav (optional, non-project pages) -->
    <section id="page-nav"> ... </section>
  </div>

  <!-- Footer -->
  <footer id="clapat-footer"> ... </footer>

</div>
```

---

## Hero section variants

### Caption only (no media)

```html
<div id="hero">
  <div id="hero-wrapper">
    <div id="hero-caption" class="content-full-width text-align-default-desktop">
      <div class="inner">
        <h1 class="hero-title caption-timeline">
          <span class="word-wrapper"><span>Studio</span></span>
          <span class="word-wrapper"><span>Name</span></span>
        </h1>
        <div class="hero-subtitle caption-timeline">
          <span class="word-wrapper"><span>Your tagline here</span></span>
        </div>
      </div>
    </div>
    <div id="hero-footer" class="has-border">
      <div class="hero-footer-left">
        <div id="scroll-down" class="button-wrap button-link right circle-edge" data-sticky>
          <div class="icon-wrap">
            <div class="icon-effects parallax-wrap" data-ball-color="primary">
              <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-down"></i></div>
            </div>
          </div>
          <div class="text-wrap sticky">
            <div class="button-text parallax-element"><span data-hover="Scroll to Explore">Scroll to Explore</span></div>
          </div>
        </div>
      </div>
      <div class="hero-footer-center">
        <div class="info-text"><span>Your info text</span></div>
      </div>
      <div class="hero-footer-right">
        <!-- optional right element -->
      </div>
    </div>
  </div>
</div>
```

### Hero with image media (used on project pages)

Add `class="has-media"` to `#hero` and `class="autoscroll"` to auto-scroll past the hero on click:

```html
<section id="hero" class="has-media autoscroll">
  <div id="hero-wrapper">
    <div id="hero-caption" class="content-full-width text-align-default-desktop">
      <!-- caption content same as above -->
    </div>
    <div id="hero-footer" class="has-border">
      <!-- footer content same as above -->
    </div>
  </div>

  <!-- Image hero media -->
  <div id="hero-media" class="parallax-media">
    <div id="hero-media-effects">
      <div id="hero-media-wrapper">
        <img src="images/01hero.jpg" class="item-image" alt="Hero Image">
      </div>
    </div>
  </div>
</section>
```

Add `change-header-color` or `change-header-color1` to `#hero-media` to control header color over the media.

### Hero with video media

Replace the `<img>` inside `#hero-media-wrapper` with a video:

```html
<div id="hero-media-wrapper">
  <video autoplay loop muted playsinline class="item-image">
    <source src="images/hero-video.mp4" type="video/mp4">
  </video>
</div>
```

### Hero with slider shortcode

Replace the `#hero` div entirely with the slider:

```html
<div class="clapat-slider-wrapper showcase-slider-parallax clapat-slider-shortcode change-header-color">
  <div class="clapat-slider fit-thumb-screen fit-with-cover" data-ball-drag="horizontal">
    <div class="clapat-slider-viewport">
      <div class="clapat-slide">
        <div class="item-content trigger-item">
          <div class="item-effects">
            <a class="item-link" data-type="page-transition" href="project01.html"></a>
            <div class="item-media trigger-item-link">
              <div class="item-media-wrapper">
                <img src="images/01hero.jpg" class="item-image" alt="Item Image">
              </div>
            </div>
          </div>
          <div class="item-caption">
            <div class="item-title" data-ball="hover" data-ball-type="blur" data-ball-color="#b880ff" data-ball-size="small" data-ball-radius="rounded" data-ball-info="fa-solid fa-arrow-right" data-ball-info-color="#000">
              <span>Project Title</span>
            </div>
            <div class="item-date"><span>2026</span></div>
            <div class="item-cat"><span>Category</span></div>
          </div>
        </div>
      </div>
      <!-- repeat .clapat-slide for each slide -->
    </div>

    <div class="clapat-caption-wrapper">
      <div class="clapat-slider-caption"></div>
    </div>
  </div>

  <div class="clapat-slider-footer fade-slide-element fadeout-element">
    <div class="clapat-slider-pagination heading-3"></div>
    <div class="slider-footer-left">
      <div class="clapat-slider-progress">
        <div class="progress-info-fill">Drag to Explore</div>
        <div class="progress-info-empty">Drag to Explore</div>
      </div>
    </div>
    <div class="slider-footer-center">
      <div class="clapat-slider-navigation">
        <div class="button-wrap cp-button-prev">
          <div class="icon-wrap">
            <div class="icon-effects parallax-wrap" data-ball-size="match" data-ball-color="primary" data-ball-radius="circle">
              <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-left"></i></div>
            </div>
          </div>
        </div>
        <div class="cp-buttons-caption">Navigate</div>
        <div class="button-wrap cp-button-next">
          <div class="icon-wrap">
            <div class="icon-effects parallax-wrap" data-ball-size="match" data-ball-color="primary" data-ball-radius="circle">
              <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-right"></i></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slider-footer-right">
      <div class="info-text"><span>Featured Project</span></div>
    </div>
  </div>
</div>
```

---

## Content rows and columns

All page content lives inside `#main-page-content` as `<section class="content-row">` blocks.

### Content row

```html
<section class="content-row [modifiers]" data-bgcolor="#f7f7f7">
  <div class="columns-group">
    <div class="[column-width]">
      <!-- content -->
    </div>
  </div>
</section>
```

**Row modifiers:**
```
full                    ← removes horizontal padding
row_padding_top         ← adds top padding
row_padding_bottom      ← adds bottom padding
row_padding_left        ← adds left padding
row_padding_right       ← adds right padding
light-section           ← white/light background mode
dark-section            ← black/dark background mode
reveal-stripes-top      ← animated stripe reveal entering from top
reveal-stripes-bottom   ← animated stripe reveal entering from bottom
change-header-color     ← triggers header color change
disable-header-gradient ← disables header gradient over this section
```

**Column widths (inside `.columns-group`):**
```
one_full      → 100%
one_half      → 50%
one_third     → 33.33%
two_third     → 66.66%
one_fourth    → 25%
two_fourth    → 50%
three_fourth  → 75%
```

**Column alignment helpers:**
```
justify_content_center
align_content_center
align_content_end_desktop
```

### Section background color

`data-bgcolor` on a `<section>` sets that section's background. The framework reads this during scroll and transitions the page background color smoothly. Works on both `<section class="content-row">` and `#clapat-page-content`.

---

## AJAX page transitions

### Internal link (uses AJAX)

```html
<a class="ajax-link" data-type="page-transition" href="about.html">Link text</a>
```

Both `class="ajax-link"` and `data-type="page-transition"` are required. Without either, the link does a full page reload.

### External link (no AJAX — never use ajax-link on external URLs)

```html
<a href="https://external.com" target="_blank" rel="noopener">External link</a>
```

### Page nav transition (non-project pages)

```html
<section id="page-nav" class="flip-title-onload">
  <div class="nav-intro-wrapper heading-4 text-align-center">
    <hr class="animated-line draw-line segmented-line from-center">
    <div class="nav-intro-text">Next Page</div>
  </div>
  <div id="page-nav-caption" class="content-full-width full-height-caption-desktop text-align-center">
    <div class="wrapper">
      <a class="next-ajax-link-page" data-type="page-transition" href="portfolio-grid.html" data-ball="hover" data-ball-type="blur" data-ball-color="#b880ff" data-ball-size="small" data-ball-radius="rounded" data-ball-info="fa-solid fa-arrow-right" data-ball-info-color="#000"></a>
      <div class="inner">
        <div class="next-hero-title caption-timeline inline-word-wrapper1">
          <span class="word-wrapper"><span>Next Page Title</span></span>
        </div>
        <div class="next-hero-subtitle caption-timeline">
          <span class="word-wrapper"><span>Subtitle</span></span>
        </div>
      </div>
    </div>
  </div>
</section>
```

### Project nav transition (project pages)

```html
<section id="project-nav" class="flip-title-onload" data-next-bgcolor="#0c0c0c">
  <div id="project-nav-wrapper">
    <div id="project-nav-caption" class="content-full-width text-align-center">
      <div class="wrapper">
        <a class="next-ajax-link-project" data-type="page-transition" href="project02.html" data-ball="hover" data-ball-type="blur" data-ball-color="#b880ff" data-ball-size="small" data-ball-radius="rounded" data-ball-info="fa-solid fa-arrow-right" data-ball-info-color="#000"></a>
        <div class="inner">
          <div class="next-hero-title caption-timeline">
            <span class="word-wrapper"><span>Next Project Title</span></span>
          </div>
          <div class="next-hero-subtitle caption-timeline">
            <span class="word-wrapper"><span>Next Project</span></span>
          </div>
        </div>
      </div>
    </div>
    <div class="next-project-media">
      <div class="next-project-media-effects">
        <div class="next-project-media-wrapper">
          <img src="images/02hero.jpg" class="item-image" alt="Next Project">
          <!-- optional video preview -->
          <div class="item-video-wrapper">
            <video loop muted playsinline class="item-video">
              <source src="images/02hero.mp4" type="video/mp4">
            </video>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
```

**Project nav chain (project01 → project08, loops back to project01):**
```
project01 → project02 → project03 → project04 → project05 → project06 → project07 → project08 → project01
```
When adding a new project, insert it into the chain and update the surrounding projects' `next-ajax-link-project` hrefs.

`data-next-bgcolor` on `#project-nav` sets the background color that fills in during the transition to the next project.

### Adding a new page

1. Duplicate any existing HTML file.
2. Rename it.
3. Update `<title>`, meta description, canonical, OG tags in `<head>`.
4. Update the `active` class in the navigation to match the new page.
5. Update `data-bgcolor` and `dark-content`/`light-content` on `#clapat-page-content`.
6. Replace all page content inside `#main-page-content`.
7. If the page uses page nav: update `next-ajax-link-page` href and the page nav title.
8. Add the page to the navigation and footer sitemap in all other HTML files.

---

## Project page anatomy

Full structure of a project page from `#clapat-page-content` inward:

```html
<div id="clapat-page-content" class="light-content" data-bgcolor="#0c0c0c">

  <!-- Header (same as all pages) -->

  <div id="content-scroll">

    <!-- Hero with media -->
    <section id="hero" class="has-media autoscroll">

      <div id="hero-wrapper">
        <div id="hero-caption" class="content-full-width text-align-default-desktop">
          <div class="inner">
            <h1 class="hero-title caption-timeline">
              <span class="word-wrapper"><span>Project Title</span></span>
            </h1>
            <div class="hero-subtitle caption-timeline">
              <span class="word-wrapper"><span>Project description</span></span>
            </div>
            <div class="hero-infotitle caption-timeline">
              <span class="word-wrapper"><span class="heading-3">2026</span></span>
            </div>
          </div>
        </div>

        <div id="hero-footer" class="has-border">
          <div class="hero-footer-left">
            <!-- scroll-down button -->
          </div>
          <div class="hero-footer-center">
            <div class="info-text"><span>Created 2026</span></div>
          </div>
          <div class="hero-footer-right">
            <!-- project credits button -->
            <div id="project-credits" class="button-wrap button-link left circle-edge open-modal" data-sticky data-modal-target="#hero-modal" data-modal-direction="right">
              <div class="icon-wrap">
                <div class="icon-effects parallax-wrap" data-ball-color="primary">
                  <div class="button-icon parallax-element"><i class="fa-regular fa-file"></i></div>
                </div>
              </div>
              <div class="text-wrap sticky">
                <div class="button-text parallax-element"><span data-hover="Project Credits">Project Credits</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Hero image media -->
      <div id="hero-media" class="parallax-media">
        <div id="hero-media-effects">
          <div id="hero-media-wrapper">
            <img src="images/01hero.jpg" class="item-image" alt="Project Image">
          </div>
        </div>
      </div>

      <!-- Credits modal source -->
      <div id="hero-modal" class="modal-source">
        <div class="modal-project">
          <p>Client:</p>
          <h5>Client Name</h5>
          <hr class="animated-line">
          <p>Overview:</p>
          <p class="no-margins">Project overview text.</p>
          <hr>
          <div class="button-wrap button-icon-box apart-icon right rounded-edge small-btn" data-sticky>
            <a target="_blank" href="https://client-website.com">
              <div class="icon-wrap">
                <div class="icon-effects parallax-wrap">
                  <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-right"></i></div>
                </div>
              </div>
              <div class="text-wrap">
                <div class="button-text"><span data-hover="Live Website">Live Website</span></div>
              </div>
            </a>
          </div>
        </div>
      </div>

    </section>

    <!-- Main content: content-row sections -->
    <div id="main-content">
      <div id="main-page-content">
        <!-- content rows here -->
      </div>

      <!-- Project nav -->
      <section id="project-nav" ...>
    </div>

    <!-- Project footer (minimal — no full footer content) -->
    <footer id="clapat-footer" class="absolute">
      <div id="footer-container">
        <div class="footer-credits">
          <!-- back to top + copyright + socials -->
        </div>
      </div>
    </footer>

  </div>
</div>
```

### Project content patterns

**Full-width image:**
```html
<section class="content-row full row_padding_top row_padding_bottom row_padding_left row_padding_right dark-section" data-bgcolor="#111">
  <div class="columns-group">
    <div class="one_full">
      <figure data-animate>
        <a href="images/projects/01project1.jpg" class="image-link">
          <img src="images/projects/01project1.jpg" alt="Image Title">
        </a>
        <figcaption>Caption</figcaption>
      </figure>
    </div>
  </div>
</section>
```

**Two-column image gallery:**
```html
<div class="columns-group">
  <div class="one_half">
    <figure data-animate>
      <a href="images/projects/01project2.jpg" class="image-link">
        <img src="images/projects/01project2.jpg" alt="Image Title">
      </a>
      <figcaption>Caption</figcaption>
    </figure>
  </div>
  <div class="one_half">
    <figure data-animate>
      <a href="images/projects/01project3.jpg" class="image-link">
        <img src="images/projects/01project3.jpg" alt="Image Title">
      </a>
      <figcaption>Caption</figcaption>
    </figure>
  </div>
</div>
```

**Text with mask animation:**
```html
<h3 class="has-mask" data-play-once>Your heading text here.</h3>
<p class="has-mask" data-play-once>Your paragraph text.</p>
```

**Content slider in project:**
```html
<div class="clapat-slider-wrapper content-slider small-looped-carousel autocenter animated-entry">
  <div class="clapat-slider">
    <div class="clapat-slider-viewport">
      <div class="clapat-slide"><div class="slide-img"><img src="images/projects/01project4.jpg" alt="Image Title"></div></div>
      <div class="clapat-slide"><div class="slide-img"><img src="images/projects/01project5.jpg" alt="Image Title"></div></div>
    </div>
  </div>
  <div class="clapat-controls">
    <div class="clapat-button-prev slider-button-prev"></div>
    <div class="clapat-button-next slider-button-next"></div>
    <div class="clapat-slider-pagination"></div>
  </div>
</div>
```

**Video player:**
```html
<div class="video-wrapper autocenter has-animation" data-controls data-poster="images/projects/02project_poster.jpg">
  <video class="bgvid" controls loop preload="auto">
    <source src="images/projects/02project_video.mp4" type="video/mp4">
  </video>
</div>
```

### Adding a new project

1. Duplicate `project08.html` → rename to `project09.html`.
2. Update `<head>`: title, meta, canonical, OG tags.
3. Update `#clapat-page-content`: set correct `class` (light/dark-content) and `data-bgcolor`.
4. Update hero: replace title, subtitle, year, and media image.
5. Update credits modal: replace client name, overview text, live website URL.
6. Replace all project content images — keep naming convention: `09project1.jpg`, `09project2.jpg`, etc. in `images/projects/`.
7. Update `#project-nav`: set `href` to next project, update `data-next-bgcolor`, update next project title, update preview image.
8. Update the previous last project (`project08.html`) so its `next-ajax-link-project` href points to `project09.html`.
9. Add a thumbnail for the new project to all three portfolio pages (`portfolio-grid.html`, `portfolio-carousel.html`, `portfolio-lists.html`).

---

## Portfolio system

### Grid thumbnail

```html
<div class="clapat-item [category-filter]">
  <div class="item-content trigger-item" data-ball="hover" data-ball-type="solid" data-ball-color="#fff" data-ball-size="auto" data-ball-radius="rounded" data-ball-info="Discover" data-ball-info-color="#000" data-ball-class="thumb-hover">
    <div class="item-effects">
      <a class="item-link" data-type="page-transition" href="project01.html"></a>
      <div class="item-media trigger-item-link">
        <div class="item-media-wrapper">
          <img src="images/01hero.jpg" class="item-image" alt="Item Image">
        </div>
      </div>
    </div>
    <div class="item-caption">
      <div class="item-title"><span>Project Title</span></div>
      <div class="item-date"><span>2026</span></div>
      <div class="item-cat"><span data-hover="Case Study">Category</span></div>
    </div>
  </div>
</div>
```

**Category filter classes:** Add to `.clapat-item` to assign the item to a filter category. Match the `data-filter` value on the filter buttons:
```
photo-filter
design-filter
video-filter
brand-filter
dev-filter
```

### Grid filter buttons

```html
<ul class="portfolio-filters">
  <li class="filters-timeline" data-ball="highlight">
    <a id="all" class="filter-option is_active" href="#" data-filter=""><span>All</span></a>
  </li>
  <li class="filters-timeline" data-ball="highlight">
    <a class="filter-option" href="#" data-filter="photo-filter"><span>Photo</span></a>
  </li>
</ul>
```

### Thumbnail with video (shows video on hover)

Add `data-video` to `.item-media-wrapper`:
```html
<div class="item-media-wrapper" data-video="images/02hero.mp4">
  <img src="images/02hero.jpg" class="item-image" alt="Item Image">
</div>
```

---

## Text animations

Add these classes to any text element. Animations trigger when the element enters the viewport.

```
has-blur        ← blur in
has-slide       ← slide up
has-fade        ← fade in
has-opacity     ← opacity fade
has-mask        ← mask reveal (clip-path)
has-fill        ← fill/color reveal
```

By default, animations replay every time the element enters the viewport. Add `data-play-once` to play only once:
```html
<h2 class="has-mask" data-play-once>Title text</h2>
```

For scroll-triggered vs load-triggered, wrap titles in caption-timeline:
```html
<h1 class="hero-title caption-timeline">
  <span class="word-wrapper"><span>Word</span></span>
</h1>
```

---

## Parallax elements

```html
<!-- Parallax on a columns-group -->
<div class="columns-group" data-parallax-start="150" data-parallax-end="-50" data-parallax-mobile="false">
  ...
</div>

<!-- Parallax on any element -->
<div data-parallax-start="100" data-parallax-end="-100">
  ...
</div>
```

---

## Appearing elements

```html
<div data-animate>...</div>
<div data-animate data-animate-translate="20">...</div>
```

`data-animate-translate` sets the vertical travel distance in px. Default is `30`.

---

## Buttons

### Icon + text button (standard)

```html
<div class="button-wrap button-icon-box apart-icon right rounded-edge" data-sticky>
  <a class="ajax-link" data-type="page-transition" href="about.html">
    <div class="icon-wrap">
      <div class="icon-effects parallax-wrap">
        <div class="button-icon parallax-element">
          <i class="fa-solid fa-arrow-right"></i>
        </div>
      </div>
    </div>
    <div class="text-wrap">
      <div class="button-text">
        <span data-hover="Read More">Read More</span>
      </div>
    </div>
  </a>
</div>
```

**Button style modifiers:**
```
outline-solid       ← outlined border style
reveal-icon         ← icon reveals on hover
apart-icon          ← icon and text separated
rounded-edge        ← rounded corners
circle-edge         ← full circle
small-btn           ← smaller size
header-element-color ← adapts to header color scheme
```

**Button layout modifiers:**
```
left    ← aligns content left
right   ← aligns content right (default)
```

---

## Cursor data attributes

Add to any element to control cursor behavior on hover:

```
data-ball="hover"         ← activates hover state
data-ball="highlight"     ← subtle highlight
data-ball="hide"          ← hides cursor
data-ball-type="solid"    ← solid fill
data-ball-type="blur"     ← blur effect
data-ball-type="outline"  ← outline only
data-ball-color="#b880ff" ← custom color (hex or CSS variable name: "primary")
data-ball-size="small"    ← small size
data-ball-size="large"    ← large size
data-ball-size="auto"     ← auto size
data-ball-size="match"    ← matches element size
data-ball-size="grow"     ← grows on hover
data-ball-radius="square"   ← square
data-ball-radius="rounded"  ← rounded corners
data-ball-radius="circle"   ← full circle
data-ball-info="Drag Me"    ← text label inside cursor
data-ball-info="fa-solid fa-arrow-right" ← Font Awesome icon inside cursor
data-ball-info-color="#000" ← label/icon color
data-ball-class="thumb-hover" ← adds custom class to cursor on hover
data-ball-drag="horizontal"   ← drag cursor (horizontal)
data-sticky                   ← cursor sticks to element center on hover
```

---

## Marquee

```html
<div class="marquee-wrapper" data-ball="hover" data-ball-type="blur" data-ball-color="#b880ff" data-ball-size="auto" data-ball-radius="rounded" data-ball-info="Drag Me" data-ball-info-color="#000">
  <div class="marquee" data-direction data-velocity data-drag>
    <div class="marquee-line heading-1 small-image">
      <div class="marquee-text">Text Item</div>
      <div class="marquee-image">
        <img src="images/star.png" width="44" height="44" alt="Star">
      </div>
      <div class="marquee-text">Text Item</div>
      <div class="marquee-image">
        <img src="images/star.png" width="44" height="44" alt="Star">
      </div>
    </div>
  </div>
</div>
```

`data-direction` → defaults to left; set `data-direction="right"` to reverse.
`data-velocity` → scroll speed multiplier; default is `1`.
`data-drag` → enables drag interaction.

---

## Pinned lists

```html
<div class="pinned-lists-wrapper direct-scroll top-reveal-mode">
  <ul class="pinned-lists heading-1">
    <li>List item one</li>
    <li>List item two</li>
    <li>List item three</li>
  </ul>
</div>
```

**Modifiers:**
```
direct-scroll     ← items pin and scroll naturally
top-reveal-mode   ← items reveal from top
text-align-center ← centered alignment
```

---

## Cylinder lists

```html
<div class="cylinder-lists-wrapper">
  <div class="cylinder-lists-mask"></div>
  <div class="cylinder-lists-header text-align-left">
    <p class="no-margins body-medium">Section label</p>
  </div>
  <div class="cylinder-lists-content heading-3 text-align-left">
    <ul class="cylinder-lists">
      <li>Item one</li>
      <li>Item two</li>
      <li>Item three</li>
    </ul>
  </div>
</div>
```

---

## Clients slider

```html
<div class="clients-table-slider autocenter cols-4">
  <ul class="clients-table active">
    <li data-ball="highlight" data-animate data-animate-translate="20">
      <div class="client-wrapper">
        <a target="_blank" href="https://client.com">
          <img src="images/client-01.png" alt="Client Name">
        </a>
      </div>
    </li>
    <!-- repeat for each client -->
  </ul>
  <div class="clients-table-navigation" data-animate data-animate-translate="10">
    <div class="button-wrap clients-button-prev">
      <div class="icon-wrap">
        <div class="icon-effects parallax-wrap" data-ball-size="match" data-ball-color="inherit">
          <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-left"></i></div>
        </div>
      </div>
    </div>
    <div class="button-wrap clients-button-next">
      <div class="icon-wrap">
        <div class="icon-effects parallax-wrap" data-ball-size="match" data-ball-color="inherit">
          <div class="button-icon parallax-element"><i class="fa-solid fa-arrow-right"></i></div>
        </div>
      </div>
    </div>
  </div>
</div>
```

`cols-4` → 4 columns grid. Change to `cols-3`, `cols-5`, etc.

---

## Clock widget

```html
<div class="clock-widget" data-timezone="Europe/Berlin" data-format="12h">
  <div class="clock-label">CEST Berlin</div>
  <div class="clock-time heading-5">Time</div>
</div>
```

`data-timezone` → any IANA timezone string (e.g. `America/New_York`, `Asia/Tokyo`).
`data-format` → `12h` or `24h`.

---

## Modals

**Trigger button:**
```html
<div class="open-modal" data-modal-target="#my-modal" data-modal-direction="right">
  Open Modal
</div>
```

**Modal source (hidden until triggered):**
```html
<div id="my-modal" class="modal-source">
  <div class="modal-project">
    <p>Label</p>
    <h5>Title</h5>
    <hr class="animated-line">
    <p class="no-margins">Content here.</p>
  </div>
</div>
```

`data-modal-direction` → `right`, `left`, `top`, `bottom`.

---

## Footer structure (full footer — non-project pages)

```html
<footer id="clapat-footer" class="change-header-color">
  <div id="footer-container" class="parallax-footer full-height-desktop">

    <div class="footer-content">
      <!-- Big title -->
      <div class="columns-group">
        <div class="three_fourth">
          <div class="big-title">Studio Name</div>
        </div>
        <div class="one_fourth justify_content_center align_content_end_desktop">
          <hr class="destroy">
          <!-- clock widget here -->
          <hr>
        </div>
      </div>

      <div class="columns-group">
        <div class="one_full"><hr class="animated-line"></div>
      </div>

      <!-- Contact + sitemap -->
      <div class="columns-group">
        <div class="one_half">
          <hr>
          <p class="body-medium no-margins">Work with Us</p>
          <hr>
          <p>hello@studio.com <br> Street, City, ZIP <br> 9AM – 6PM</p>
        </div>
        <div class="one_half">
          <hr>
          <p class="body-medium no-margins">Sitemap</p>
          <hr>
          <div class="footer-nav-wrapper">
            <ul class="footer-nav-lists">
              <li data-ball="highlight"><a class="arrow-link ajax-link" href="index.html" data-type="page-transition">Index</a></li>
              <li data-ball="highlight"><a class="arrow-link ajax-link" href="about.html" data-type="page-transition">About</a></li>
              <li data-ball="highlight"><a class="arrow-link ajax-link" href="contact.html" data-type="page-transition">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-credits">
      <div class="clapat-footer-left">
        <div id="backtotop" class="button-wrap button-link left circle-edge" data-sticky>
          <div class="icon-wrap">
            <div class="icon-effects parallax-wrap" data-ball-size="grow" data-ball-color="primary" data-ball-radius="circle">
              <div class="button-icon parallax-element"><i class="fa-solid fa-angle-up"></i></div>
            </div>
          </div>
          <div class="text-wrap">
            <div class="button-text"><span data-hover="Back to Top">Back to Top</span></div>
          </div>
        </div>
      </div>
      <div class="clapat-footer-center">
        <div class="copyright">2026 © Studio Name. All rights reserved.</div>
      </div>
      <div class="clapat-footer-right">
        <div id="footer-socials" class="socials-wrap">
          <div class="socials-text">Follow Us</div>
          <ul class="socials">
            <li>
              <span class="parallax-wrap" data-ball-size="grow" data-ball-color="primary" data-ball-radius="circle">
                <a class="parallax-element" href="https://instagram.com/yourstudio" target="_blank" aria-label="Follow on Instagram">
                  <i class="fa-brands fa-instagram"></i>
                </a>
              </span>
            </li>
            <!-- repeat for each social -->
          </ul>
        </div>
      </div>
    </div>

  </div>
</footer>
```

---

## Colors (css/variables.css)

```css
--primary-color: #b880ff;       /* accent — cursor, buttons, highlights */
--secondary-color: #b880ff;     /* keep same as primary */
--color-black: #000;
--color-white: #fff;
--color-black-faded: rgba(0,0,0,0.15);
--color-white-faded: rgba(255,255,255,0.15);
--cursor-background-color: #b880ff;  /* update when changing primary */
--cursor-border-color: #b880ff;      /* update when changing primary */
```

---

## Fonts (css/variables.css)

```css
--default-font-family: 'Inter Tight';     /* body, nav, UI */
--primary-font-family: 'FunnelDisplayWeb'; /* headings, hero — name must match @font-face */
```

Font files are in `webfonts/`. `@font-face` declarations are in `style.css`. To change a font: add new `@font-face` in `css/custom.css`, update the variable in `css/variables.css`.

---

## LoadViaAjax — custom functions after AJAX

If you add a custom JavaScript function that must run after every AJAX page load, add it to both `DOMContentLoaded` and `window.LoadViaAjax` in `js/scripts.js`:

```js
document.addEventListener("DOMContentLoaded", function() {
  // ... existing initializations ...
  CustomFunction();
  MyNewFunction(); // ← add here
});

window.LoadViaAjax = function() {
  // ... existing initializations ...
  CustomFunction();
  MyNewFunction(); // ← and here
};

function MyNewFunction() {
  // your code
}
```

If it only runs in `DOMContentLoaded`, it will work on first load but not after clicking internal links.

---

## What never to touch

- `js/common.js` — core framework, will be overwritten on updates
- `js/slider.js` — slider engine, will be overwritten on updates
- `style.css` — main CSS entry point
- `css/content.css`, `css/showcase.css`, `css/portfolio.css`, `css/shortcodes.css` — core CSS
- `lib/gsap.js`, `lib/lenis.js`, `lib/three.js` — third-party libraries
- `webfonts/` — do not rename or move any file
- `images/displacement/` — do not modify, rename, or delete

All customizations go in `css/custom.css`, `css/variables.css`, and `js/scripts.js`.
