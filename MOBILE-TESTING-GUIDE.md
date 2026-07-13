# Mobile Testing Guide - HMS

## Quick Test Checklist

### 🏠 Landing Page (index.php)
Open in browser: `http://localhost/HMS/hospital/index.php`

#### Desktop (>992px)
- [ ] Full navigation bar visible
- [ ] Hero section with image and text side-by-side
- [ ] Stats in 4 columns
- [ ] Service cards in 3 columns
- [ ] Gallery in 3 columns

#### Tablet (768px - 991px)
- [ ] Navigation collapses to hamburger menu
- [ ] Hero image below text
- [ ] Stats in 4 columns (2x2 on smaller tablets)
- [ ] Service cards in 2 columns
- [ ] Gallery in 2 columns

#### Mobile (480px - 767px)
- [ ] Hamburger menu works smoothly
- [ ] Hero title readable (2rem)
- [ ] Buttons stack vertically
- [ ] Stats in 2x2 grid
- [ ] Service cards single column
- [ ] Gallery single column
- [ ] Contact form full width

#### Small Phone (<480px)
- [ ] All text legible without zoom
- [ ] Buttons full width
- [ ] Stats smaller font (1.8rem)
- [ ] No horizontal scroll
- [ ] Footer centers properly

---

### 👤 Patient Dashboard
Open: `http://localhost/HMS/hospital/hms/dashboard.php`

#### Desktop (>992px)
- [ ] Sidebar always visible on left
- [ ] Dashboard stats in 3 columns
- [ ] Quick action cards in 3 columns
- [ ] Welcome banner full width

#### Tablet (768px - 1024px)
- [ ] Sidebar still visible (narrower)
- [ ] User name/role hidden in header
- [ ] Stats adapt to 2-3 columns
- [ ] Cards adapt layout

#### Mobile (<768px)
- [ ] Sidebar hidden by default
- [ ] Hamburger button visible (☰)
- [ ] Tap hamburger → sidebar slides in from left
- [ ] Overlay appears behind sidebar
- [ ] Tap overlay or link → sidebar closes
- [ ] Stats stack in single column
- [ ] Quick action cards single column
- [ ] Welcome banner icon hidden on very small screens

**Mobile Menu Test:**
1. Tap hamburger menu
2. Verify sidebar slides in smoothly
3. Verify dark overlay appears
4. Tap "Book Appointment"
5. Verify sidebar closes automatically
6. Verify you navigated to booking page

---

### 👨‍💼 Admin Dashboard
Open: `http://localhost/HMS/hospital/hms/admin/dashboard.php`

#### Desktop (>992px)
- [ ] Admin sidebar always visible
- [ ] Stat cards in 4 columns
- [ ] Quick actions in 3 columns
- [ ] Submenu expands/collapses

#### Tablet (768px - 1024px)
- [ ] Sidebar narrower but visible
- [ ] User details hidden in header
- [ ] Stats in 2 columns
- [ ] Actions in 2-3 columns

#### Mobile (<768px)
- [ ] Sidebar hidden by default
- [ ] Hamburger visible (☰)
- [ ] Tap hamburger → sidebar slides in
- [ ] Submenu toggle works (Doctors, Users, etc.)
- [ ] Overlay backdrop works
- [ ] Tap any link → sidebar closes
- [ ] Stats single column
- [ ] Actions single column
- [ ] Tables scroll horizontally if needed

**Submenu Test (Mobile):**
1. Open hamburger menu
2. Tap "Doctors" (has arrow icon)
3. Verify submenu expands below
4. Tap "Add Doctor"
5. Verify sidebar closes and navigates

---

## Browser DevTools Testing

### Chrome/Edge DevTools:
1. Press `F12` to open DevTools
2. Click **Toggle Device Toolbar** (Ctrl+Shift+M)
3. Select device from dropdown:
   - iPhone SE (375 x 667)
   - iPhone 12 Pro (390 x 844)
   - Pixel 5 (393 x 851)
   - Samsung Galaxy S20 (360 x 800)
4. Test in both portrait and landscape

### Firefox Responsive Design Mode:
1. Press `Ctrl+Shift+M`
2. Choose preset or enter custom dimensions
3. Test various sizes

### Manual Resize Method:
1. Open page in browser
2. Resize browser window gradually
3. Watch for layout changes at breakpoints:
   - 1024px (tablet starts)
   - 768px (mobile starts)
   - 480px (small phone adjustments)

---

## Common Issues to Check

### ❌ Problems to Look For:
- Horizontal scrolling (indicates overflow)
- Text too small to read
- Buttons too small to tap (< 44px)
- Overlapping elements
- Content cut off
- Images not scaling
- Menu not opening/closing
- Form fields too narrow

### ✅ Expected Behavior:
- No horizontal scroll at any width
- All text readable without zoom
- Buttons/links easy to tap (44px min)
- Smooth menu animations
- Proper spacing between elements
- Images scale proportionally
- Tables scroll horizontally when needed
- Forms usable with mobile keyboard

---

## Quick Mobile Simulator Links

If using localhost, access from your phone on same network:
1. Find your computer's local IP: `ipconfig` (Windows) or `ifconfig` (Mac/Linux)
2. Open on phone: `http://YOUR-IP/HMS/hospital/index.php`
3. Example: `http://192.168.1.100/HMS/hospital/index.php`

---

## Performance Tips

### Mobile Performance:
- Page should load in < 3 seconds on 3G
- No layout shifts after page load
- Smooth scrolling (60fps)
- Menu animations < 300ms

### Test Performance:
1. Chrome DevTools → Lighthouse tab
2. Select "Mobile" device
3. Run audit
4. Check "Performance" score (aim for 90+)

---

## Breakpoint Reference

```
Small phones:    320px - 479px
Standard phones: 480px - 767px
Tablets:         768px - 1024px
Desktops:        1025px+
```

### Key Breakpoints Used:
- `@media (max-width: 480px)` - Small phones
- `@media (max-width: 767px)` - Mobile phones
- `@media (max-width: 768px)` - Mobile & small tablets
- `@media (max-width: 991px)` - Tablets
- `@media (max-width: 1024px)` - Large tablets

---

## Success Criteria

The HMS is considered fully mobile-responsive when:

✅ **All pages load correctly on phones 320px+ wide**  
✅ **Navigation works with hamburger menu**  
✅ **No horizontal scrolling on any page**  
✅ **All text is readable without zooming**  
✅ **All buttons/links are tap-friendly (44px+)**  
✅ **Forms are usable with mobile keyboard**  
✅ **Images scale properly**  
✅ **Tables scroll horizontally when needed**  
✅ **Performance is acceptable (< 3s load on 3G)**

---

## Need Help?

If you encounter issues:
1. Check browser console for errors (F12)
2. Verify file paths are correct
3. Clear browser cache
4. Test in incognito/private mode
5. Try different browser/device

## Files Modified:
- `hospital/index.php` - Landing page
- `hospital/hms/dashboard.php` - Patient dashboard
- `hospital/hms/admin/dashboard.php` - Admin dashboard
- CSS files were already responsive (no changes needed)
