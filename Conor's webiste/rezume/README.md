# Rezume - Personal Resume & Portfolio Template

A clean, modern single-page resume and portfolio HTML template built with Bootstrap 5.3.8 and vanilla JavaScript. Originally by [Colorlib](https://colorlib.com), fully upgraded for modern web standards.

## Live Sections

- **Hero** - Full-screen intro with background image
- **Trusted By Leading Brands** - Client logos with brand colors
- **Portfolio** - Filterable grid with Isotope and GLightbox
- **Resume** - Work experience and education timeline
- **About** - Bio, skills, and progress bars
- **Case Studies** - Project highlights with metrics
- **Services** - Icon-based service cards
- **Testimonials** - Client quotes
- **Blog** - Latest posts preview
- **Certifications & Awards** - Professional credentials
- **Contact** - Contact form and social links

## Tech Stack

| Category | Technology |
|----------|-----------|
| CSS Framework | Bootstrap 5.3.8 (source SCSS) |
| JavaScript | Vanilla JS (no jQuery) |
| Animations | AOS 2.3.4 |
| Lightbox | GLightbox 3 |
| Portfolio Filter | Isotope 3 (CDN) |
| Icons | icomoon custom font + inline SVG |
| Images | WebP with JPG fallbacks |

## Features

- **Dark Mode** - Toggle with animated sun/moon SVG icons, localStorage persistence, system preference detection
- **WebP Images** - All images use `<picture>` elements with JPG fallbacks
- **Non-Blocking CSS** - AOS and GLightbox CSS loaded asynchronously
- **Accessible** - Skip-to-content link, ARIA labels, semantic HTML landmarks
- **SEO Ready** - Open Graph, Twitter Cards, meta descriptions
- **Portfolio Lightbox** - Click anywhere on portfolio items (image or text) to open
- **Responsive** - Mobile-first with collapsible navigation

## Quick Start

1. Clone or download the template
2. Open `index.html` in a browser
3. Customize content, images, and colors

## Development

### Prerequisites

- [Dart Sass](https://sass-lang.com/install) for SCSS compilation

### Build

```bash
# Compile SCSS (minified)
sass scss/style.scss css/style.css --style=compressed

# Watch mode
sass --watch scss/style.scss:css/style.css
```

### File Structure

```
rezume/
├── css/
│   ├── bootstrap.css          # Bootstrap 5.3.8 compiled
│   ├── style.css              # Main stylesheet (compiled)
│   ├── aos.css                # AOS animations
│   └── glightbox.min.css      # GLightbox styles
├── scss/
│   ├── style.scss             # Main SCSS source
│   ├── _site-darkmode.scss    # Dark mode overrides
│   ├── _custom-settings.scss  # Bootstrap variable overrides
│   └── bootstrap/             # Bootstrap 5.3.8 source (do not modify)
├── js/
│   ├── main.js                # Custom vanilla JavaScript
│   ├── bootstrap.bundle.min.js
│   ├── aos.js
│   ├── glightbox.min.js
│   └── vendor/                # imagesLoaded
├── fonts/
│   └── icomoon/               # Custom icon font
├── images/                    # WebP + JPG originals
└── index.html                 # Main template
```

### JavaScript Modules (`js/main.js`)

| Function | Purpose |
|----------|---------|
| `initDarkMode()` | Dark mode toggle with localStorage |
| `initSmoothScroll()` | Smooth scroll navigation |
| `initNavbarState()` | Sticky navbar after 200px scroll |
| `initPortfolioFilter()` | Isotope grid filtering |
| `initLightbox()` | GLightbox + portfolio text click handling |
| `initMobileMenuClose()` | Close mobile menu on link click |

### Dark Mode

Toggle via `data-bs-theme` attribute on `<html>`. Custom styles in `scss/_site-darkmode.scss` with accent color `#bac964`.

### Customization

- **Colors**: Edit `$primary` in `scss/_custom-settings.scss`, dark accent in `scss/_site-darkmode.scss`
- **Fonts**: Change Google Fonts link in `index.html` `<head>`
- **Content**: Edit sections directly in `index.html`
- **Images**: Replace files in `images/`, provide both `.webp` and `.jpg` versions

## CDN Dependencies

- [Isotope](https://isotope.metafizzy.co/) - Portfolio filtering
- [imagesLoaded](https://imagesloaded.desandro.com/) - Image load detection

## Browser Support

- Chrome, Firefox, Safari, Edge (latest 2 versions)
- iOS Safari, Android Chrome

## Credits

- Original template: [Colorlib](https://colorlib.com)
- Bootstrap: [getbootstrap.com](https://getbootstrap.com)
- AOS: [michalsnik/aos](https://github.com/michalsnik/aos)
- GLightbox: [biati-digital/glightbox](https://github.com/biati-digital/glightbox)
- Icons: [icomoon.io](https://icomoon.io)

## License

Template licensed under [Colorlib license](https://colorlib.com/wp/licence/).
