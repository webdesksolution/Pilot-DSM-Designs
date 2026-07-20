---
template_type: handoff
applies_to: ["all"]
last_reviewed: 2026-06-03
---

# HANDOFF.md Template — v1.11.2

> Copy this file to the root of your project repository as `HANDOFF.md`. Updated at the end of every session by whoever closes the session. Read FIRST by whoever opens the next session.

---

## Purpose

Capture working state at session end. Resume in 30 seconds, not 5 minutes.

Read order at session start: `CLAUDE.md` (project memory) → `outputs/<slug>/sow-spec.md` (intake) → `HANDOFF.md` (this file).

**Hard cap: 200 lines.** If it grows, archive to `docs/session-handoffs/<date>-<slug>.md` and reset.

---

## Last session

- **Session ended:** {{YYYY-MM-DD HH:MM TZ}}
- **Session ID:** {{session-id-if-tracked}}
- **Last active agent:** {{pm-agent / designer-agent / dev-engineer / qa-agent / etc.}}
- **Active milestone:** {{M0 / M1 / M2 / M3 / M4 / M5}}
- **Active sprint:** {{S1 / S2 / ...}}
- **Active gate:** {{G0 / G0.5 / G1 / G2 / G3 / G4 / G5 / G6}}

---

## Where we left off

Single short paragraph. What was the LAST concrete thing being done? At what exact point did we stop?

Example:
> Was building `section-hero.php` template. Hero markup complete, mobile responsive styles pending. Next action: write mobile styles for hero in `sass/sections/_hero.scss` then compile CSS. No blockers.

If the session ended because of a context limit / error / interruption, say so:
> Session hit 200K context error after extensive Elementor template work. Resume by reloading minimal context (CLAUDE.md + HANDOFF.md only) and continuing the remaining 2 template files.

---

## Files pushed this session

Files committed to git in this session:

- `wp-content/themes/hello-elementor-child/sass/sections/_hero.scss` — new file, hero section styles
- `wp-content/themes/hello-elementor-child/template-parts/sections/section-hero.php` — new template part
- (etc.)

---

## Files pending push

Files edited but NOT yet committed (work in progress):

- `wp-content/plugins/client-elementor-widgets/widgets/class-industry-picker-widget.php` — 60% complete, controls registered, render() pending
- (etc.)

These should be committed (or stashed) before the next session unless intentionally left dirty.

---

## Next 3 tasks (queued)

Concrete, actionable. The next session resumes from here.

**RECONCILIATION RULE (v1.11.11+):** At session end, reconcile this list against work actually completed during the session. Remove items that got done. Append genuinely new items. Do NOT just append — that grows staleness. If a queued task was completed, delete the row; if partially completed, rewrite with the remaining scope. Empty is a valid state — better than stale.

1. {{Task 1 — specific. Example: "Finish `class-industry-picker-widget.php` render() method per architecture doc section 20."}}
2. {{Task 2}}
3. {{Task 3}}

After these 3, see CLAUDE.md "Active tasks (this sprint)" for the broader backlog.

---

## Client blockers (waiting on)

Format: `[opened-date] — what we're waiting on. Owner: Internal PM / client / vendor. Target unblock date.`

- [2026-06-03] — Brand color palette finalization. Owner: Internal PM (Daniel D.) following up with client. Target unblock: 2026-06-05.
- {{Other blockers}}

If empty: `_(none)_`

PM Agent reviews staleness (open >7 days) at every G4 sprint review.

---

## Open failure modes captured this session

Anything that surprised us or revealed a gap. Per K4 — feeds back into KB updates.

- {{Example: "Elementor Theme Style regeneration paused admin for 45 seconds on this site. Mid-project Theme Style changes need an off-peak window. Captured for v1.11.x note."}}
- (etc.)

If empty: `_(none — clean session)_`

---

## Decisions made this session

One line per locked decision. Format: `[YYYY-MM-DD] [D-CODE if applicable] — summary.`

These should also be appended to `CLAUDE.md` "Recent decisions" section.

- {{Example: "[2026-06-03] D-WP-03 Path B confirmed for this project. Theme Style locked at end of G2."}}
- (etc.)

---

## Token usage this session (optional)

If tracking:

- Input tokens: {{N}}
- Output tokens: {{N}}
- Estimated cost: ${{N}}
- Cumulative project cost: ${{N}} / ${{budget}}

Per `tools/scripts/token-estimator.py`. Skip if not tracking.

---

## What NOT to do on resume

If we discovered something to avoid, note it here. Example:

- Do NOT enable WP Rocket's "Combine JS" — broke the Elementor mobile menu. Confirmed via test, reverted, left disabled.
- Do NOT update Elementor Pro to 3.21 yet — known regression with our custom widget. Stay on 3.20.x until resolved.
- (etc.)

If empty: `_(no specific cautions)_`

---

## Session links

- Last commit: `{{commit-hash}}` on branch `{{branch-name}}`
- Latest staging URL: {{url}}
- Latest mockup preview URL (if active): {{url}}
- Open PRs: {{list with URLs}}
- Open issues: {{list with URLs}}

---

## Presentational-only components (v1.11.11+)

Components built to spec but not yet wired to a functional backend. Rendered as visually-disabled placeholders per session-handoff-protocol.md convention. Client sees "not yet activated" — not "broken."

Format per row: `component-name — activated by {plugin-or-module} — wiring estimate {hours}`.

- {{Example: `pre-order-button — activated by "YITH Pre-Order for WooCommerce" plugin — wiring estimate ~3h`}}
- {{Example: `wishlist-icon — activated by TI WooCommerce Wishlist module — wiring estimate ~4h`}}

If empty: `_(none — every rendered component is functional)_`

---

## Notes for next session

Anything else the next session needs to know. Optional. Keep brief.

- {{Example: "Client confirmed they want the FAQ accordion to auto-close other items when one opens. Update widget config when resuming."}}
- (etc.)

---

Last touched: 2026-07-20T12:49:19Z
Touched by: init-project.sh
