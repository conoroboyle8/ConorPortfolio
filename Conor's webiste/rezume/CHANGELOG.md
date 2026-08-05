# Changelog

All notable changes to this project will be documented in this file.

## [2.0.2] - 2026-01-26

### New Features

- Animated dark mode toggle with SVG sun/moon icons that rotate and scale on switch
- Client logos section with brand-specific colors (Google, Microsoft, Apple, Amazon, Netflix, Spotify)
- New content sections: Trusted By Leading Brands, Case Studies, Certifications & Awards

### Fixed

- Portfolio lightbox now opens when clicking anywhere on the image (not just the small preview icon)
- Portfolio item text (title/category) now also triggers the lightbox on click
- Dark mode navbar is fully transparent until user scrolls, eliminating the black bar at the top
- Hero text contrast improved (white text over dark hero image)
- Service section icons changed to white for proper contrast on blue backgrounds
- Dark mode toggle no longer shows underline styling
- Dark mode toggle visible in both scrolled and non-scrolled navbar states

### Improved

- Contact form inputs made more compact with proper spacing between fields
- Brand colors preserved in both light and dark mode for client logos
- Apple logo color adjusted to lighter gray (#aaa) for dark mode readability

## [2.0.1] - 2026-01-25

### Fixed

- Fixed light/dark mode distinction - base theme is now properly light (#f8f9fa background, dark text)
- Dark mode now correctly restores the original dark template design (#222 background, #333 cards)
- Restored original dark mode primary color `#bac964` (lime/olive green)
- Updated all component styles for proper light/dark mode contrast

## [2.0.0] - 2026-01-24

### Major Changes

- Upgraded from Bootstrap 4 to Bootstrap 5.3.8
- Removed jQuery dependency completely
- Replaced Waypoints with AOS 2.3.4 for scroll animations
- Replaced Magnific Popup with GLightbox 3 for image lightbox
- Removed Stellar.js parallax (CSS handles background attachment now)
- Removed Flexslider (unused)
- Removed jQuery Easing (using CSS transitions)

### New Features

- Dark mode toggle with localStorage persistence and system preference detection
- WebP image support with `<picture>` fallbacks for all images
- Non-blocking CSS loading for better performance
- Skip-to-content link for accessibility
- Portfolio filtering with Isotope 3

### Improvements

- Minified CSS output via Dart Sass
- Optimized font loading with preconnect and preload
- Added SEO meta tags (description, Open Graph, Twitter Cards)
- Added ARIA labels to all interactive elements
- Added `<main>` landmark for accessibility
- Improved image alt text throughout
- Updated to Google Analytics 4 placeholder
- Smooth scroll navigation with URL hash updates

### Files Removed

- `js/vendor/jquery.min.js`
- `js/vendor/jquery-migrate-3.0.1.min.js`
- `js/vendor/jquery.easing.1.3.js`
- `js/vendor/jquery.stellar.min.js`
- `js/vendor/jquery.waypoints.min.js`
- `js/vendor/jquery.magnific-popup.min.js`
- `js/vendor/jquery.flexslider-min.js`
- `js/vendor/popper.min.js`
- `js/vendor/bootstrap.min.js`
- `js/custom.js`, `js/custom.min.js`
- `js/scripts.js`, `js/scripts.min.js`
- `js/google-map.js`
- `css/animate.css`
- `css/flexslider.css`
- `css/magnific-popup.css`

### Files Added

- `js/main.js` - Vanilla JavaScript (modular, ~180 lines)
- `js/bootstrap.bundle.min.js` - Bootstrap 5 bundle (includes Popper)
- `js/aos.js` - AOS animation library
- `js/glightbox.min.js` - GLightbox library
- `css/aos.css` - AOS styles
- `css/glightbox.min.css` - GLightbox styles
- `scss/_site-darkmode.scss` - Dark mode styles

### Migration Notes

If upgrading from v1.0:

1. All `data-toggle` attributes changed to `data-bs-toggle`
2. All `data-target` attributes changed to `data-bs-target`
3. Spacing classes changed: `pr-*` → `pe-*`, `pl-*` → `ps-*`, `mr-*` → `me-*`, `ml-*` → `ms-*`
4. Lightbox class changed: `.img-pop-up` → `.glightbox`
5. Animation class changed: `.site-animate` → `data-aos="fade-up"`
6. jQuery plugins replaced with vanilla JS equivalents

---

## [1.0.0] - Original Release

- Original Colorlib Rezume template
- Bootstrap 4.x with jQuery
- Waypoints for scroll animations
- Magnific Popup for lightbox
- Stellar.js for parallax
