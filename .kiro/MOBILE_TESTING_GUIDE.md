# 📱 Mobile Testing Guide - HMS+

## Quick Test Checklist

### Landing Page (index.php)

#### ✅ Navbar (All Screens)
- [ ] Logo displays correctly
- [ ] Hamburger appears on mobile (≤768px)
- [ ] Menu slides in smoothly
- [ ] Links close menu on tap
- [ ] Active link highlighted
- [ ] Smooth scroll works

#### ✅ Hero Section
**Desktop (≥992px)**
- [ ] Two-column layout
- [ ] Floating stat cards visible
- [ ] Background animations smooth
- [ ] All text readable

**Tablet (768-991px)**
- [ ] Stacked layout
- [ ] Stats hidden or adjusted
- [ ] Images scale properly
- [ ] Buttons full-width or centered

**Mobile (≤767px)**
- [ ] Single column
- [ ] Centered content
- [ ] Proper font scaling
- [ ] CTAs stack vertically

#### ✅ Services Section
**Desktop**: 3 cards per row
**Tablet**: 2 cards per row
**Mobile**: 1 card per row
- [ ] Cards maintain aspect ratio
- [ ] Hover effects work (desktop)
- [ ] Icons scale properly
- [ ] Text remains readable

#### ✅ Gallery
- [ ] Filter pills wrap on mobile
- [ ] Grid adjusts columns
- [ ] Lightbox works on tap
- [ ] Images don't overflow
- [ ] Close button accessible

#### ✅ Contact Form
- [ ] Inputs at least 44px tall
- [ ] Labels visible
- [ ] Validation works
- [ ] Submit button full-width on mobile
- [ ] Form doesn't zoom on input focus

---

### Patient Dashboard (hms/dashboard.php)

#### ✅ Sidebar Navigation
**Desktop (≥769px)**
- [ ] Fixed sidebar visible
- [ ] All menu items visible
- [ ] Hover effects work
- [ ] Active state highlighted

**Mobile (≤768px)**
- [ ] Sidebar hidden by default
- [ ] Hamburger button visible
- [ ] Sidebar slides in from left
- [ ] Backdrop overlay appears
- [ ] Tap outside closes sidebar
- [ ] Links close sidebar on tap

#### ✅ Header Bar
**Desktop**
- [ ] Page title with icon
- [ ] User info with dropdown
- [ ] Back button with text

**Mobile**
- [ ] Hamburger on left
- [ ] Compact title (no icon on small screens)
- [ ] User avatar only
- [ ] Back button (icon only)

#### ✅ Dashboard Cards
**Stat Cards**
- [ ] Desktop: 3 columns
- [ ] Tablet: 2 columns  
- [ ] Mobile: 1 column
- [ ] Numbers large and readable
- [ ] Icons scale properly

**Quick Action Cards**
- [ ] Desktop: 3 columns
- [ ] Tablet: 2 columns
- [ ] Mobile: 1 column
- [ ] Touch targets 44px+
- [ ] Icons visible
- [ ] Hover effects (desktop only)

#### ✅ Forms & Tables
- [ ] Inputs scale properly
- [ ] Min 44px height on mobile
- [ ] Tables scroll horizontally if needed
- [ ] Buttons full-width on small screens
- [ ] Date/time pickers work on mobile
- [ ] Validation messages visible

---

## 📐 Viewport Sizes to Test

| Device | Width | What to Check |
|--------|-------|---------------|
| iPhone SE | 375px | Smallest modern phone |
| iPhone 12 | 390px | Standard iPhone |
| iPhone 12 Pro Max | 428px | Large phone |
| iPad Mini | 768px | Tablet portrait |
| iPad Pro | 1024px | Tablet landscape |
| Desktop | 1440px+ | Full experience |

---

## 🔧 Testing Tools

### Browser DevTools
```
Chrome/Edge: F12 → Toggle Device Toolbar (Ctrl+Shift+M)
Firefox: F12 → Responsive Design Mode (Ctrl+Shift+M)
Safari: Develop → Enter Responsive Design Mode
```

### Online Tools
- [Responsive Design Checker](https://responsivedesignchecker.com/)
- [BrowserStack](https://www.browserstack.com/)
- [LambdaTest](https://www.lambdatest.com/)

### Real Devices (Recommended)
- Test on at least 1 iOS and 1 Android device
- Check both portrait and landscape
- Test with slow network (DevTools → Network Throttling)

---

## 🐛 Common Issues & Fixes

### Issue: Content overflows on small screens
**Fix**: Check for fixed widths, use `max-width: 100%`

### Issue: Text too small on mobile
**Fix**: Use relative units (rem/em), check CSS variables

### Issue: Buttons too small to tap
**Fix**: Ensure `min-height: 44px` and adequate padding

### Issue: Horizontal scroll appears
**Fix**: Check for fixed widths, ensure `overflow-x: hidden` on body

### Issue: Sidebar doesn't close
**Fix**: Check JavaScript event handlers, ensure overlay has z-index

### Issue: Forms zoom on input focus (iOS)
**Fix**: Ensure `font-size` is at least 16px on inputs

---

## ⚡ Performance Checks

- [ ] Page loads in <3 seconds on 3G
- [ ] Smooth 60fps animations
- [ ] No layout shift on load
- [ ] Images properly sized
- [ ] CSS/JS minified for production

---

## ♿ Accessibility Tests

- [ ] Tab navigation works
- [ ] Screen reader announces menu state
- [ ] Color contrast passes WCAG AA
- [ ] Touch targets 44x44px minimum
- [ ] Zoom works up to 200%
- [ ] No horizontal scroll at 320px width

---

## 📝 Test Report Template

```markdown
## Test Results - [Date]

### Device: [Device Name]
### Browser: [Browser Name & Version]
### Viewport: [Width x Height]

#### Landing Page
- Navigation: ✅ / ❌
- Hero: ✅ / ❌
- Services: ✅ / ❌
- Gallery: ✅ / ❌
- Contact: ✅ / ❌

#### Dashboard
- Sidebar: ✅ / ❌
- Header: ✅ / ❌
- Cards: ✅ / ❌
- Forms: ✅ / ❌

#### Issues Found:
1. [Description]
2. [Description]

#### Screenshots:
[Attach if needed]
```

---

## 🎯 Priority Testing Matrix

| Feature | Desktop | Tablet | Mobile | Priority |
|---------|---------|--------|--------|----------|
| Navigation | ✅ | ✅ | ✅ | High |
| Forms | ✅ | ✅ | ✅ | High |
| Sidebar | ✅ | ✅ | ✅ | High |
| Hero Section | ✅ | ✅ | ✅ | Medium |
| Gallery | ✅ | ✅ | ✅ | Medium |
| Animations | ✅ | ✅ | ⚠️ | Low |

Legend: ✅ Must work | ⚠️ Can simplify | ❌ Can disable

---

**Happy Testing! 🚀**
