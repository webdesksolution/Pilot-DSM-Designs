---
tier: 3
load_when: ["human-reference-only"]
description: Per-project memory file. Lives at the root of every client project repository. Claude Code auto-loads CLAUDE.md from the project root on every session start. This file is the canonical place for project-level memory and the bridge to sow-spec.md.
applies_to: ["all"]
decision_refs: ["D-MEMORY-01"]
---

# CLAUDE.md Template — v1.11.0

> Copy this file to the root of every project repository as `CLAUDE.md`. Claude Code auto-loads it on session start. Replace `{{...}}` placeholders with real values during G0 setup.

---

## How to use this file

1. PM Agent generates this file at G0 from the intake / spec data.
2. Updated at every gate transition (G0, G0.5, G1, G2, G3, G4, G5, G6).
3. Updated when a major decision is made (recorded as a new entry under "Recent decisions").
4. Updated when a blocker is opened or resolved.
5. Read by EVERY agent at the start of EVERY session.

The file MUST stay under 300 lines. If it grows beyond that, split older entries into `docs/handoff-log-<date>.md` and keep only the current state here.

---

## Project identity

- **Client:** DSM Designs LLC
- **DBA:** DSM Designs
- **Slug:** dsm-designs
- **Current website:** https://dsmdesigns.dreamhosters.com/
- **Project type:** redesign    <!-- redesign / new-build / version-upgrade / migration / b2b-wholesale-setup / multi-region-multi-store-setup -->
- **Platform:** wordpress-woocommerce              <!-- shopify / shopify-plus / wordpress / woocommerce / bigcommerce / magento / adobe-commerce -->
- **Plan tier:** standard
- **Target launch date:** 2026-08-20
- **Hard deadlines:** none

---

## SOW + Spec references

- **SOW client doc:** `outputs/dsm-designs/sow-client.md`
- **SOW spec (AI-facing):** `outputs/dsm-designs/sow-spec.md`
- **Intake YAML:** `outputs/dsm-designs/inputs/intake.yaml`
- **Estimation spreadsheet:** `outputs/dsm-designs/inputs/estimation.csv`

PM Agent reads `sow-spec.md` at G0 Step 0 — frontmatter pre-fills ~85% of intake fields.

---

## Team

- **Internal PM:** Jay <jay@webdesksolution.ca>
- **WebDesk Designer:** Dipen
- **WebDesk Dev Lead:** Brijesh D
- **WebDesk QA Lead:** James T

**Client primary contact:** see `flag_004_blocklist` in `sow-spec.md`. NEVER contact directly — route all comms through Internal PM (FLAG-004, COMM-005).

---

## Current gate state

- **Current gate:** G0    <!-- G0 / G0.5 / G1 / G2 / G3 / G4 / G5 / G6 / post-launch -->
- **Gate entered at:** 2026-07-20
- **Next gate target:** TBD
- **Last completed gate:** none

### Gate completion log

| Gate | Status | Completed | Sign-off |
|------|--------|-----------|----------|
| G0 — Intake | in_progress | — | — |
| G0.5 — Audit | {{g0_5_status}} | {{g0_5_date}} | {{g0_5_signoff}} |
| G1 — Plan | {{g1_status}} | {{g1_date}} | {{g1_signoff}} |
| G2 — Design (HTML mockups) | {{g2_status}} | {{g2_date}} | {{g2_signoff}} |
| G3 — Scaffold | {{g3_status}} | {{g3_date}} | {{g3_signoff}} |
| G4 — Sprint QA | {{g4_status}} | {{g4_date}} | {{g4_signoff}} |
| G5 — Milestone | {{g5_status}} | {{g5_date}} | {{g5_signoff}} |
| G6 — Pre-launch | {{g6_status}} | {{g6_date}} | {{g6_signoff}} |

---

## Recent decisions (most recent first)

Format: `[YYYY-MM-DD] [Decision code if applicable] — one-line summary. Source: who/where.`

- [2026-07-20] G0 credentials/API items — hosting creds, GitHub repo URL, payment gateway sandbox, K+N API access: dev team manages hosting+repo directly; payment gateway + K+N handled after go-live. Source: Jay (Internal PM).
- [2026-07-20] RFI-017 (Product Add-Ons plugin publisher/edition/license) — hold question until GATE-04, not asked at G0. Do not re-raise as blocker before then. Source: Jay.
- [2026-07-20] Agent-Ready Scope v1.2 (`outputs/dsm-designs/DSM_Designs_Agent_Ready_Scope_v1_2.docx`) read in full — confirms MOD-05 (Design System) status was `BLOCKED pending GATE-02` at authorship. This validates the "build mockup fresh" instruction below — sow-spec's "design complete and approved" framing was wrong, not the other way around. Full module/gate/RFI list (MOD-01..19, GATE-00..07, RFI-001..028) now available for reference.
- [2026-07-20] **SUPERSEDES prior entry below** — HTML mockup is NOT pre-built. Team must CREATE the HTML mockup fresh, matching the look/quality of reference site https://dsmdesigns.dreamhosters.com/. sow-spec's "design complete and approved, mockup_url is the deliverable" framing does not hold — that URL is a reference standard, not the mockup artifact. Reopens the design workstream that sow-spec/CLAUDE.md previously marked closed. Source: Jay. **Risk:** sow-spec's 10-hour Design Questionnaire & Discovery line (Sprint 2) assumed design was already done — building a new mockup from scratch may not fit that budget. Flag at G1 planning, do not silently absorb.
- ~~[2026-07-20] G0 design confirm — no new design rounds; approved mockup at https://dsmdesigns.dreamhosters.com/ stands~~ — superseded same day, see entry above.
- [2026-07-20] G0 catalog data — product/category export to be pulled from live site https://dsmdesigns.dreamhosters.com/ (DATA-01/RFI-015). Source: Jay.
- [2026-07-20] Elementor version — use whatever is locally installed (4.1.5), not the 4.0.3 sow-spec cites. No version pin; local install is the source of truth. Free edition, page-content canvas only per MOD-05A still applies. Source: Jay.
- [2026-07-20] GitHub repo URL set: https://github.com/webdesksolution/Pilot-DSM-Designs.git. Source: Jay.

For full decision history beyond the last 5-10, see `docs/decision-log.md`.

---

## Open blockers

Format: `[priority] [opened-date] — description. Owner: who. Target unblock: date.`

- _(empty if none)_
- {{blocker_1}}
- {{blocker_2}}

PM Agent reviews this list at every G4 sprint review and surfaces stale blockers (open >7 days).

---

## Required-from-client (status)

| Item | Due | Status |
|------|-----|--------|
| Logo (vector + raster) | {{logo_due}} | {{logo_status}} |
| Brand color palette | {{brand_colors_due}} | {{brand_colors_status}} |
| Product photography | {{photography_due}} | {{photography_status}} |
| Page content / copy | {{copy_due}} | {{copy_status}} |
| Hosting credentials | dev-managed | deferred |
| DNS access | TBD | pending |
| Existing site admin access | dev-managed | deferred |
| GitHub repo URL | TBD | pending — client to provide later |
| Payment gateway sandbox creds | post go-live | deferred |
| Kuehne + Nagel API access/creds | post go-live | deferred |
| Product Add-Ons plugin license/edition | GATE-04 | deferred — ask at GATE-04, not before |
| Catalog sample/export | TBD | pending — pull from live site |

Status legend: `pending` / `received` / `partial` / `overdue`.

---

## Design tool

- **Tool:** HTML
- **Rationale:** D-DES-01 — HTML mockups only. No Adobe XD / Figma / Sketch / PSD as deliverable.
- **Homepage revisions allowed:** 3
- **Other-page revisions allowed:** 3
- **Mockup files location:** `mockups/` in this repo

---

## Platform configuration

- **Platform:** wordpress-woocommerce
- **Plan tier:** standard
- **Hosting:** local XAMPP (dev) / existing DreamHost (client's current site — no migration)
- **Theme baseline:** vanilla-wp+custom (D-WP-01) — custom theme `dsm-designs`, no parent theme
- **Repo URL:** https://github.com/webdesksolution/Pilot-DSM-Designs.git
- **Branch strategy:** main + per-milestone branches (see `git-branch-strategy.md`)
- **Local dev URL:** http://localhost/newWP2
- **Staging URL:** TBD
- **Production URL (not yet live for new-builds):** {{production_url}}

---

## Apps / plugins installed

| App / plugin | Version | License | Notes |
|--------------|---------|---------|-------|
| Elementor | 4.1.5 | Free | Locally installed version used as-is, not pinned to sow-spec's 4.0.3. Page-content canvas only (MOD-05A). |
| WooCommerce | 10.9.4 | — | Locally installed |
| Contact Form 7 | — | — | Matches live site's form provider |

INT-002 applies: shipping / payment / tax configuration is ALWAYS manual. AI does not auto-configure.

---

## Active tasks (this sprint)

Format: brief description, owner, due date.

- Pull product + category export from https://dsmdesigns.dreamhosters.com/ for DATA-01/RFI-015. Owner: dev. Due: TBD.
- Credentials handoff channel still unanswered — need secure vault method (1Password/etc) before hosting/WP admin creds move. Owner: Jay. Due: TBD.

Detail in `tasks/` directory or external PM tool (Linear / Asana / etc. per project).

---

## Session log pointer

Last session ended at: {{last_session_end_timestamp}}
Last session summary: `docs/session-handoffs/{{last_session_handoff_filename}}`

Per `session-handoff-protocol.md`, every session ends with a HANDOFF.md update. Read the latest handoff before starting work.

---

## What this file does NOT contain

- Client emails / phones / handles → those live in `sow-spec.md` `flag_004_blocklist` only
- Code or full design specs → those live in their respective directories
- Long decision rationale → only one-line summaries here; full rationale in `docs/decision-log.md`
- Sprint-level tasks → those live in your PM tool
- Test results → those live in `docs/qa-reports/`

This file is INDEX + LATEST STATE only. Keep it under 300 lines.

---

Last touched: 2026-07-20T12:49:19Z
Touched by: init-project.sh


---

## Required skill files for this project (v1.11.2+)

> CRITICAL — this section tells Claude what to load. Without it, Claude may auto-load everything (200K context error).

When this project's session starts, load ONLY these files:

### Always load
- `skills/_spine/persona.md`
- `skills/_spine/shared-knowledge/forbidden-global.md`
- `skills/_spine/shared-knowledge/ai-tool-rules.md`

### Active agents (load when needed)
- `skills/_spine/pm-agent/SKILL.md`
- `skills/_spine/designer-agent/SKILL.md`
- `skills/_spine/qa-agent/SKILL.md`
- `skills/_spine/code-review-agent/SKILL.md`

### Platform skill
- `skills/wordpress-woocommerce/SKILL.md`

### Project-type skill
- `skills/wordpress-woocommerce/projects/redesign/SKILL.md`

### Platform knowledge files (load on demand based on task)
- For Elementor builds: load `08-page-builders.md` + `20-elementor-architecture.md` + `21-elementor-performance.md` + `22-elementor-qa-checklist.md` + `23-scss-architecture-wp.md`
- For ACF builds: load `07-classic-editor-and-acf.md` + `06-theme-structure-patterns.md`
- For both: `05-security-baseline.md` + `14-app-plugin-ecosystem.md` (always when writing code)

### Do NOT load
- Other platform folders (shopify/, bigcommerce/, magento-adobe-commerce/ etc. — unless that's THIS project's platform)
- `docs/` (human reference only — read directly, don't auto-load)
- KB files outside the lists above unless explicitly requested

### Required project files
- `CLAUDE.md` (this file, project root, auto-loaded)
- `HANDOFF.md` (project root, auto-loaded if present)
- `outputs/dsm-designs/sow-spec.md` (if SOW Builder produced it)
