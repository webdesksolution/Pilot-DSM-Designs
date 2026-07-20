---
# Identification
spec_version: 1.1
generated_at: 2026-07-20T12:40:39Z
generated_by: sow-builder@1.1
client_slug: dsm-designs
client_legal_name: "DSM Designs LLC"
client_dba: "DSM Designs"

# Project parameters
platform: woocommerce
plan_tier: standard
project_type: redesign
current_website: "https://dsmdesigns.dreamhosters.com/"
target_launch_date: 2026-08-20
hard_deadlines: []
date_quoted: 2026-07-17

# Pricing — AI-facing only (internal)
total_hours: 120
hourly_rate_internal: not_provided
total_cost_usd: 3800
discount_pct: 0
payment_terms_template: "pending — legal team"

# Team
internal_pm_name: "Jay"
internal_pm_email: jay@webdesksolution.ca
webdesk_designer: "Dipen"
webdesk_dev_lead: "Brijesh D"
webdesk_qa_lead: "James T"

# Design enforcement (D-DES-01)
design:
  tool: HTML
  rationale: D-DES-01
  status: approved
  mockup_revisions_homepage: 3
  mockup_revisions_other_pages: 3
  mockup_url: "https://dsmdesigns.dreamhosters.com/"
  implementation_layer: "Elementor Free 4.0.3 (page-content canvas only, per MOD-05A)"
  client_provided_design: none
  client_provided_design_notes: "HTML mockup produced by WebDesk, approved by client, live at mockup_url."
  prohibited:
    - Adobe XD
    - Figma (as deliverable)
    - PSD
    - Sketch
    - InVision
    - Marvel

# FLAG-004 client contact blocklist
flag_004_blocklist:
  source: "sales_intake + live_site_scan_2026-07-20"
  emails:
    - daniel.p@dsmdesigns.net
    - info@dsmdesigns.net
  phones:
    - "515.965.3182"
  handles:
    - "tiktok.com/@dsmdesigns"
    - "instagram.com/dsm_designs"
    - "facebook.com/dsmdesigns"
    - "facebook.com/p/DSM-Designs-100053255395306"
    - "youtube.com/@dsm_designs"
    - "pinterest.com/dsmdesigns"
  domains:
    - dsmdesigns.net
    - dsmdesigns.dreamhosters.com
  contact_form_urls:
    - "https://dsmdesigns.dreamhosters.com/contact/"
  chat_handles: []
  unresolved:
    - "caitlinkellnerportfolio.my.canva.site/dsmdesignservices — third-party design-services page linked from client Contact page. Ownership unconfirmed. Treat as blocked until PM confirms contractor vs client-owned."
  notes:
    - "Intake supplied daniel.p@dsmdesign.net; corrected to dsmdesigns.net by sales at generation time."
    - "info@dsmdesigns.net, phone, and five social handles added from live Contact page + footer scan."

# Companion contract artifact
companion_documents:
  agent_ready_scope:
    filename: "DSM_Designs_Agent_Ready_Scope_v1_2.docx"
    document_id: DSM-ARS-001
    version: 1.2
    date: 2026-07-16
    authority: "Requirement baseline. Module contracts MOD-01..MOD-19, gates GATE-00..GATE-07, RFI-001..RFI-028."
    relationship: "This spec is the commercial/effort layer. The Agent-Ready Scope is the requirement layer. Where effort and requirement disagree, raise a CONFLICT record; do not select."

# Spreadsheet metadata
spreadsheet:
  filename: "DSM_Design____eCommerce_Website_DevelopmentV1_1.xlsx"
  sheet: "Final for Agent"
  version: V1.1
  total_hours_declared: 120
  total_hours_calculated: 116.75
  match: false
  variance_hours: 3.25
  variance_disposition: "Accepted by sales at generation time. 120 is the commercial figure of record; 116.75 is the sum of sheet line items. Do not halt on this delta."

# Validation flags
validation:
  platform_conflicts_found: 0
  platform_conflicts_resolved: 0
  client_name_corrections: 1
  design_tool_conflicts_found: 1
  design_tool_conflicts_resolved: 1
  revision_count_conflicts_found: 1
  revision_count_conflicts_resolved: 1
  contact_email_corrections: 1
  rewrites_count: 4
  hours_variance_accepted: true
  status: passed_with_logged_variance

# PM Agent hand-off
pm_agent_handoff:
  intake_fields_prefilled:
    - platform
    - plan_tier
    - project_type
    - current_website
    - target_launch_date
    - hard_deadlines
    - total_hours
    - total_cost_usd
    - design_tool
    - design_status
    - mockup_url
    - flag_004_blocklist
    - internal_pm
    - webdesk_designer
    - webdesk_dev_lead
    - webdesk_qa_lead
    - elementor_version
    - contact_form_provider
  intake_fields_remaining:
    - hosting_credentials_handoff_protocol
    - github_repo_url
    - product_addons_plugin_publisher_edition_version
    - elementor_free_vs_pro_license_verification
    - payment_gateway_sandbox_credentials
    - kuehne_nagel_api_access_and_credentials_owner
    - brand_asset_locations
    - catalog_sample_export
---

## Project Summary

DSM Designs LLC (DBA DSM Designs) is a WooCommerce **redesign** on the standard tier. The engagement rebrands and re-implements an existing WordPress/WooCommerce salon-furniture storefront on its existing DreamHost environment — no host migration, no platform migration. Scope covers theme and template styling, a dynamic three-level category mega menu, WooCommerce Product Add-Ons attribute pricing, laminate and hardware swatch UI, transactional email styling, responsive work, and a **discovery-only** Kuehne + Nagel freight quoting engagement.

Commercial scope: **120 hours / $3,800 USD**, across 4 milestones and 8 sprints. Target launch **2026-08-20**.

The design phase is **already complete and approved**. The HTML mockup is live at the client's staging URL and has been implemented in Elementor Free 4.0.3. D-DES-01 is satisfied — the deliverable was HTML, not a design-file handoff.

All client communication routes through the Internal PM (Jay). FLAG-004 blocklist captured at intake and extended by a live site scan.

**Companion artifact:** this spec does not restate the requirement contracts. `DSM_Designs_Agent_Ready_Scope_v1_2.docx` (DSM-ARS-001 v1.2) holds MOD-01 through MOD-19, GATE-00 through GATE-07, and RFI-001 through RFI-028. That document governs *what* is built and to what acceptance criteria. This spec governs *how much effort was sold and against which sprint*. Read both.

---

## Module-by-Module Scope

Every row below traces 1:1 to the "Final for Agent" sheet. Sub-items with no hours are **named deliverables absorbed into the parent line's hours** — they are in scope, they are not separately funded, and no agent may treat a zero-hour sub-item as out of scope or as an invitation to assign its own estimate.

The `Maps to` column is a **derived** mapping from sprint rows to Agent-Ready Scope module IDs. It is an aid, not a signed baseline. Confirm at GATE-00.

### Milestone 1

#### Sprint 1 — Analysis & Kick Off (7 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Task #1 — Scope Validation | 2 | GATE-00, MOD-01 |
| Task #2 — Required items to kick start the project | 1 | MOD-01, CLIENT-01..08 |
| Task #3 — Project Planning | 2 | MOD-01, milestones.json |
| Task #4 — Internal Kick Off | 2 | MOD-01 |
| Task #5 — Analysis & Kick Off (Client) | absorbed | MOD-01 |

Absorbed under Task #5:
- AM :: Meeting — Weekly Call with Client; On-Demand Call with Client; On-Demand Discussion with Developer
- AM :: Documentation — Meeting Summary Doc; Development Updates Doc; Estimation Doc

**Notes.** MOD-01 governance registers (RFI/decision register, dependency/risk/defect/change register) and the Agent Availability Records for the nine roles in the Agent-Ready Scope §11.3 are **in scope and absorbed into this sprint's 7 hours** per sales direction at generation time. They are not separately funded. Flag capacity risk at G1 rather than re-opening scope.

#### Sprint 2 — Setup & Design (15 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Server Setup → WordPress Setup | 2 | MOD-02, MOD-03 |
| Server Setup → WooCommerce Setup | 2 | MOD-04 |
| Sprint 2: Internal Setup Validation | 1 | MOD-02, GATE-01 |
| Design Questionnaire & Discovery | 10 | MOD-05, GATE-02 |
| Sprint 2: Internal Demo / Testing & QA / Documentation | absorbed | MOD-18 |
| Sprint 3: Understanding & Questions | absorbed | MOD-01 |

**The 10-hour Design Questionnaire & Discovery line is the entire design allocation.** Per sales direction, it covers all of the following collectively:

- Home Page — Homepage Design V1; Homepage Revision V2; Homepage Revision V3
- Mega Menu — Mega Menu Design; Mega Menu Design Revision
- Category Page — Category Page Design; Category Page Design Revision
- Product Page — Product Page Design; Product Page Design Revision
- About Us Page — About Us Page Design; About Us Page Design Revision
- Banner Design — Banner 1; Banner 2; Banner 3

**Design status: complete and approved.** The approved HTML mockup is live at the URL recorded in `design.mockup_url` and is already implemented in Elementor Free 4.0.3. Agents must treat design as a **closed** workstream. Do not re-open, re-derive, or re-propose design direction. New design work of any kind is a change request.

**Revision policy: 3 rounds homepage, 3 rounds per other page.** This supersedes DSN-03 in the Agent-Ready Scope, which stated five homepage rounds. See Rewrites Applied.

**Sprint 2 has no Internal Demo / Testing & QA / Documentation allocation**, unlike Sprints 3 through 7 which each carry 2.25 hours for the same three activities. This is a known asymmetry in the source sheet, accepted at generation time. PM Agent should absorb Sprint 2 QA into the Sprint 3 allocation rather than raising a variance.

### Milestone 2

#### Sprint 3 — Homepage, Mega Menu, System Pages (12.75 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Home Page Integration → HP :: Data Input | 3 | MOD-06 |
| Home Page Integration → HP :: CSS | 2 | MOD-06, MOD-05A |
| Mega Menu → Category Hierarchy | 2 | MOD-12 |
| Styling of System Pages → Blog | 3 | MOD-09 |
| Sprint 3: Internal Demo | 0.75 | MOD-18 |
| Sprint 3: Testing & QA | 1 | MOD-18 |
| Sprint 3: Documentation | 0.5 | MOD-01 |
| Sprint 4: Understanding & Questions | 0.5 | MOD-01 |

Absorbed under **Mega Menu → Category Hierarchy (2h)**: Dynamic Menu; 3-Level Navigation; Image Integration; Standard Menu Development.

Absorbed under **Styling of System Pages → Blog (3h)**: Cart Page; Checkout Page; Login/Register Page; Thank You Page; 404 Page.

**Notes.** MOD-12 caps at three displayed category levels and two promotional image slots per top-level panel. MENU-06 records promotional images as hardcoded unless GATE-02 approved an admin-managed alternative — the design is approved, so confirm which was signed. Live-site finding for GATE-01: the Color Bars category resolves to `/product-category/bar-colors/` in the header and `/product-category/color-bars/` in the footer. One is broken. Log as a pre-existing defect against MOD-12, not as new scope.

#### Sprint 4 — Category, Product, About Us, CMS Pages (15.75 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Category Page Integration → CP :: Data Input | 2 | MOD-07 |
| Category Page Integration → CP :: CSS | 2 | MOD-07 |
| Product Page Integration → PP :: Data Input | 2 | MOD-08 |
| Product Page Integration → PP :: CSS | 2 | MOD-08 |
| About Us Page Integration → AU :: Data Input | 0.75 | MOD-05A |
| About Us Page Integration → AU :: CSS | 0.75 | MOD-05A |
| Styling of CMS Pages (7 Pages) → Terms and Conditions | 3.5 | MOD-10 |
| Sprint 4: Internal Demo | 0.75 | MOD-18 |
| Sprint 4: Testing & QA | 1 | MOD-18 |
| Sprint 4: Documentation | 0.5 | MOD-01 |
| Sprint 5: Understanding & Questions | 0.5 | MOD-01 |

The 3.5-hour CMS line covers all seven pages in the canonical inventory collectively:

| # | Page | URL |
|---|---|---|
| 1 | Terms and Conditions | /terms-and-conditions/ |
| 2 | Why Us | /why-us-2/ |
| 3 | UGC Upload | /ugc-upload/ |
| 4 | Contact Us | /contact/ |
| 5 | Portfolio | /portfolio/ |
| 6 | Salon Furnishing Financing | /salon-furnishing-financing/ |
| 7 | Services | /services/ |

**MOD-09 / MOD-10 boundary.** Both modules are in scope. The seven-page canonical inventory above is a statement of *what is included*, not a double-count of effort. Contact Us appears once in the inventory; its form, map, and recipient configuration are governed by MOD-09 (SYS-03 through SYS-05) while its page-content styling sits in this line. No agent should raise CONFLICT on the MOD-10 acceptance criterion "no page is counted twice" — the inventory is the enumeration, the effort is the single 3.5-hour line.

**Live-site findings for MOD-09.** Contact form provider is Contact Form 7 with reCAPTCHA (partially answers RFI-009 — fields, recipients, consent text, retention owner still open). A raw `[cf7sr-recaptcha]` shortcode currently renders as visible text on the homepage; log as a pre-existing defect.

### Milestone 3

#### Sprint 5 — Email & Freight Discovery & Architecture (17.75 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Email Template Styling | 1 | MOD-11 |
| Kuehne + Nagel Discovery | 8 | MOD-13 |
| Product Attribute Model Design → Global Attributes | 5 | MOD-14 |
| Documentation (Workflow + Data Model) | 1 | MOD-13, MOD-14 |
| Sprint 5: Internal Demo | 0.75 | MOD-18 |
| Sprint 5: Testing & QA | 1 | MOD-18 |
| Sprint 5: Documentation | 0.5 | MOD-01 |
| Sprint 6: Understanding & Questions | 0.5 | MOD-01 |

Absorbed under **Kuehne + Nagel Discovery (8h)**: API & Authentication; Rate Logic; Request/Response Mapping; Crate Mapping; LTL vs Truckload Logic; Fallback Rules; Edge Cases.

Absorbed under **Global Attributes (5h)**: Variants Structure; Bulk Update Strategy; Crate Metadata; Data Governance.

**Hard boundary — MOD-13 is discovery only.** KN-11 prohibits production integration code, checkout rate-calculation changes, middleware deployment, and live booking. The milestone label "Integrations and Configurations" in the original source SOW does **not** authorize API development; the Agent-Ready Scope §2.3 resolves this conflict in favour of discovery. GATE-06 approves the discovery report and a *separate* implementation estimate. It does not authorize implementation. Any agent that begins writing K+N integration code is out of contract.

**Dependency risk.** MOD-13 requires responses from a third party (Kuehne + Nagel) on credentials, documentation, and sandbox access. Blocked on RFI-013 and RFI-014.

#### Sprint 6 — Product Add-Ons Pricing (11.25 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Plugin Setup & Configuration | 0.5 | MOD-15, GATE-04 |
| Global Add-On Groups | 3 | MOD-15 |
| Category Assignment | 2 | MOD-15 |
| Testing Pricing Logic → Single Add-On | 3 | MOD-15, MOD-18 |
| Sprint 6: Internal Demo | 0.75 | MOD-18 |
| Sprint 6: Testing & QA | 1 | MOD-18 |
| Sprint 6: Documentation | 0.5 | MOD-01 |
| Sprint 7: Understanding & Questions | 0.5 | MOD-01 |

Absorbed under **Global Add-On Groups (3h)**: Casters; Color Upgrade; Shelf; Tool Holder.

Absorbed under **Category Assignment (2h)**, appearing as zero-hour siblings in the sheet: Base Price Setup; Frontend Price Calculation; Admin Workflow.

Absorbed under **Testing Pricing Logic → Single Add-On (3h)**: Multiple Add-Ons; Required vs Optional.

Zero-hour line with no funded parent: **Documentation & Training**. Treated as absorbed into Sprint 6: Documentation (0.5h).

**Notes.** GATE-04 requires the exact Product Add-Ons publisher, product, edition, version, and license owner before configuration (RFI-017). Not yet supplied — this is the single most likely source of a mid-sprint block. PAO-10 prohibits replacing genuine variation-dependent inventory/SKU/image logic with add-ons unless DATA-02 explicitly approves it.

### Milestone 4

#### Sprint 7 — Swatches, Desktop & Responsive (18.25 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Laminate Swatches | 3 | MOD-16 |
| Hardware Swatches | 5 | MOD-16 |
| Responsive Development → Tablet Optimization | 3 | MOD-17 |
| Responsive Development → Mobile Optimization | 4 | MOD-17 |
| Sprint 7: Internal Demo | 0.75 | MOD-18 |
| Sprint 7: Testing & QA | 2 | MOD-18 |
| Sprint 7: Documentation | 0.5 | MOD-01 |

Absorbed under **Laminate Swatches (3h)** and, separately, **Hardware Swatches (5h)** — each covers: Backend Setup; Image Setup; Price Mapping; Frontend Display; Hover Preview.

**Notes.** SWT-04 requires the desktop large-preview pattern (tooltip, modal, or side panel) to be selected by a human at GATE-02 — the agent shall not choose. SWT-05 requires a separate non-hover mobile preview pattern. Since design is approved, both selections should already exist in the approved mockup; confirm and record rather than re-deciding. Swatch counts and assets are open under RFI-020. MOD-17's breakpoint, browser/version, and WCAG-target matrix is in scope and absorbed into the two Responsive Development lines per sales direction.

#### Sprint 8 — Go-Live & Final QA (19 hours)

| Line item | Hours | Maps to |
|---|---|---|
| Pre Go-Live Checklist | 1 | MOD-19, GATE-07 |
| Full Website Testing | 5 | MOD-18 |
| Bug Fixing & Optimization | 3 | MOD-18 |
| Go-Live Deployment | 5 | MOD-19 |
| Live QA & Validation | 5 | MOD-19 |

Absorbed under **Full Website Testing (5h)**: Desktop Testing; Responsive Testing; Functional Testing; Regression Testing.

Absorbed under **Live QA & Validation (5h)**: Client QA Support; Post-Launch Fixes.

**Notes.** Post-Launch Fixes carries no defined hypercare duration. RFI-025 (warranty/hypercare boundaries) is open and owned by the commercial owner. Until closed, PM Agent should treat post-launch support as bounded by the 5-hour Live QA & Validation line and nothing beyond it.

### Hours reconciliation

| Milestone | Sprint | Hours |
|---|---|---|
| 1 | Sprint 1 — Analysis & Kick Off | 7 |
| 1 | Sprint 2 — Setup & Design | 15 |
| 2 | Sprint 3 — HP, MM, System Pages | 12.75 |
| 2 | Sprint 4 — CP, PP, AU, CMS | 15.75 |
| 3 | Sprint 5 — Email & Freight Discovery | 17.75 |
| 3 | Sprint 6 — Product Add-Ons Pricing | 11.25 |
| 4 | Sprint 7 — Swatches & Responsive | 18.25 |
| 4 | Sprint 8 — Go-Live & Final QA | 19 |
| | **Sum of sheet line items** | **116.75** |
| | **Commercial figure of record** | **120** |
| | **Variance (accepted)** | **3.25** |

The 3.25-hour variance is accepted and recorded. `total_hours: 120` is the contractual figure. No agent should halt, reallocate, or reconcile this delta without human instruction.

---

## Required From Client

### Assets (collected via Internal PM only)
- Final brand assets, logo formats, licensed fonts, colors, imagery (DSN-01) — largely satisfied by the approved mockup; confirm source files exist
- Banner copy and licensed source assets for the three approved banners (DSN-08)
- Final legal, privacy, and business copy for the seven CMS pages (CMS-04)
- Swatch imagery — laminate and hardware, at approved dimensions and formats (SWT-02, SWT-09, RFI-020)
- Catalog sample or export for the data-model work (DATA-01, RFI-015)
- Crate dimension and weight data (DATA-04, RFI-016)

### Credentials (handed off through PM channel — never to an AI agent directly)
- Hosting and staging access, existing DreamHost environment (RFI-001, RFI-002)
- WordPress administrator access
- Product Add-Ons plugin license and admin (RFI-017)
- Elementor license confirmation — Free vs Pro must be verified in staging, not assumed (ELM-01, ELM-02)
- Payment gateway sandbox credentials (RFI-023)
- Kuehne + Nagel API documentation, sandbox, and credentials owner (RFI-013)
- DNS and SSL owner for cutover (RFI-024)

### Approvals required
- GATE-00 scope baseline
- GATE-01 environment baseline
- GATE-02 design approval — **already satisfied**; record the signed artifact and date
- GATE-03 commerce rules
- GATE-04 product option capability
- GATE-05 catalog and content freeze
- GATE-06 freight discovery completion
- GATE-07 UAT and launch

---

## Manual Config Items (INT-002)

These require human configuration and human-owned business decisions. No agent may select values.

| Item | Owner | Status |
|---|---|---|
| Shipping zones, methods, rates, free-shipping thresholds | Client | Open (WOO-06) |
| Free USA shipping rules and the AZ/CA/ID/NM/NV/UT/OR/WA surcharge under $2,000 (currently published on the live site) | Client | Open — must be reconciled against WooCommerce shipping config |
| Payment gateway selection, merchant approval, sandbox and production credentials | Client | Open (RFI-023) |
| Tax rates, nexus and legal determination, tax display settings | Client | Open (WOO-06) |
| Resale and exemption certificate handling | Client | Not addressed in source scope — raise at GATE-03 |
| Currency, selling locations, shipping destinations, units | Client | Open (GATE-03) |
| Coupons, gift certificates, order statuses | Client | Open — GC is styling only of an existing page (WOO-07) |
| Contact form recipients, consent text, spam rules, data retention owner | Client | Open (RFI-009, SYS-04) |
| Transactional email trigger inventory, sender, recipients | Client + WDS | Open (RFI-010) |
| K+N freight business rules, origins, accessorials, LTL/FTL thresholds, markup | Client | Open (RFI-014) |
| Deployment window, content freeze, rollback authorizer | Client + WDS | Open (RFI-024) |
| Warranty and hypercare duration | Commercial owner | Open (RFI-025) |

---

## Out of Scope

Anything below requires a separate quote or an approved change request.

- **Kuehne + Nagel production integration** — working rate integration, shipment booking, labels, BOL, tracking, cancellation, invoicing, middleware hosting, production credentials, production deployment, and support. MOD-13 is discovery only.
- Hosting or platform migration; server replacement; production DevOps redesign
- Full content, product, order, or customer data migration
- Catalog cleanup or bulk data population, including the test and duplicate products currently in the catalog
- Elementor Pro license and any Pro-only feature — Theme Builder, WooCommerce Builder, Form widget, Popup Builder, Global Widgets, dynamic tags, Loop Grid, custom-code manager
- Synchronized global Elementor sections; visual Elementor editing of header, footer, product, category, cart, checkout, account, 404, or email templates
- Custom payment gateway development; new gateway integration
- Tax automation beyond default WooCommerce rules; tax or legal advice
- Gift certificate engine; subscriptions; memberships; fraud tooling
- ERP, POS, CRM, or PIM integration
- 3D configurator, AR, composite or bundled-product engine, custom recommendation engine, inventory or SKU per add-on option
- Faceted search engine, infinite scroll, category-specific bespoke designs, merchandising automation
- Copywriting, legal review, content creation, product or swatch photography
- Logo, rebranding, or brand-identity creation; animation or video production; stock media purchase
- New page creation beyond the approved inventory
- New email trigger development; marketing automation; deliverability remediation; SMTP or domain authentication
- Guaranteed PageSpeed or Core Web Vitals scores; formal accessibility certification
- Load testing, penetration testing, exhaustive device lab, automated test-suite productization
- Malware cleanup; WordPress multisite conversion; legacy plugin refactoring
- Domain transfer; DNS management; ongoing maintenance; 24/7 monitoring; indefinite hypercare
- Remediation of pre-existing defects found on the live site (see Pre-Existing Defects below) unless separately approved
- SEO content strategy; paid advertising setup

---

## Pre-Existing Defects (observed, not in scope)

Found during the 2026-07-20 live scan. Recorded so agents do not mistake them for new requirements or silently fix them inside funded lines.

1. Raw `[cf7sr-recaptcha theme="dark"]` shortcode renders as visible text in the homepage contact block.
2. Color Bars category link mismatch — header resolves to `/product-category/bar-colors/`, footer to `/product-category/color-bars/`. One is broken.
3. Catalog contains test and duplicate records — "Test Bayfront Double Sided Station with LED mirror", "Quad Station Test Copy (Copy)", "Hana Double Sided Styling Station (Copy)". Relevant to DATA-01 sampling; cleanup is excluded.
4. Numerous placeholder `#` hrefs across header, hero CTAs, footer Company links, and mega-menu Shop-By items.
5. Mid-page social row links to bare `facebook.com`, `instagram.com`, and `twitter.com` rather than client profiles; Contact-page header social icons are all `#`.
6. Site-wide `robots: noindex, nofollow` — correct for staging, must be lifted at GATE-07. Add to the deployment manifest.

---

## Risks & Assumptions

### Assumptions
- Design is closed. The approved HTML mockup is the design baseline and no further design rounds are consumed.
- The existing DreamHost environment is adequate; no migration is required.
- Elementor Free is the licensed edition. **Unverified** — the live site reports Elementor 4.0.3 without edition. ELM-02 prohibits any in-scope page requiring Pro.
- Client supplies content, catalog sample, swatch assets, and crate data on schedule.
- One client Product Owner with consolidated approval authority (CLIENT-01).

### Risks

| Risk | Severity | Detail |
|---|---|---|
| Schedule compression | **High** | 8 sprints and 8 approval gates between 2026-07-20 and the 2026-08-20 target — roughly 22 business days. The 116.75 hours of effort fit; eight rounds of client written sign-off in 22 days is the constraint. GATE-06 additionally depends on a third-party carrier response. |
| K+N third-party dependency | **High** | MOD-13 cannot progress without carrier documentation, sandbox, and credentials. RFI-013 and RFI-014 open. 8 hours is a tight budget for KN-01 through KN-10 even with full cooperation. |
| Product Add-Ons plugin capability | **High** | RFI-017 unanswered. GATE-04 requires a staging capability test before configuration. If the plugin cannot do fixed-price global groups with category assignment and order persistence, Sprints 6 and 7 both block. |
| Elementor Free vs Pro | **Medium** | If any approved mockup page depends on a Pro feature, MOD-05A's boundary breaks and the Page Ownership Matrix has to be reworked. Verify in staging before Sprint 3. |
| Absorbed-scope capacity | **Medium** | MOD-01 registers, MOD-05A Page Ownership Matrix and per-page section/widget inventory, MOD-17 quality matrix, and the twelve canonical artifacts in the Agent-Ready Scope §11.2 are in scope but carry no dedicated line. Directed by sales; track actuals against sprint budgets and escalate at G1 rather than re-opening scope. |
| Sprint 2 QA gap | **Low** | Sprint 2 carries no Internal Demo / QA / Documentation allocation. Absorb into Sprint 3. |
| Compound-line attribution | **Low** | Several lines fund many sub-items collectively (Blog 3h covers six system pages; Terms 3.5h covers seven CMS pages; Global Attributes 5h covers five sub-items). Per-item attribution does not exist and must not be invented for reporting. |

---

## Rewrites Applied (audit trail)

1. **Design tool — DSN-02 (Agent-Ready Scope §MOD-05)**
   - Original: "WDS produces one homepage design direction in the approved design tool; exact tool shall be recorded rather than 'Figma or Adobe XD.'"
   - Rewritten: Design tool locked to **HTML mockup**, per D-DES-01. Mockup is complete, approved, and live; implementation layer is Elementor Free 4.0.3.
   - Reason: The source SOW named Figma/Adobe XD and v1.2 deferred rather than resolved. D-DES-01 prohibits either as a deliverable.
   - Confirmed by: Sales person at 2026-07-20T12:40:39Z

2. **Revision rounds — DSN-03 (Agent-Ready Scope §MOD-05)**
   - Original: "Up to five homepage revision rounds are included."
   - Rewritten: **3 homepage rounds, 3 rounds per other page.**
   - Reason: Three-way conflict between intake (3/3), spreadsheet (V1 + 2 homepage revisions, 1 per other page), and DSN-03 (5). Sales resolved to 3/3.
   - Confirmed by: Sales person at 2026-07-20T12:40:39Z

3. **Client legal name**
   - Original (intake): "DSM Designs"
   - Rewritten: **"DSM Designs LLC"** (per live-site footer, "Copyright © 2026 DSM Designs LLC")
   - Reason: Contracting entity must be the legal name.
   - Confirmed by: Sales person at 2026-07-20T12:40:39Z

4. **Client contact email domain**
   - Original (intake): primary contact address on the singular-form domain (`dsmdesign.net`)
   - Rewritten: same local part on the plural-form domain — see `flag_004_blocklist.emails[0]`
   - Reason: Intake typo. The live site publishes its general inbox on the plural-form domain; no singular-form domain observed anywhere in the scan. Corrected address and the general inbox are both in the frontmatter blocklist.
   - Confirmed by: Sales person at 2026-07-20T12:40:39Z

### Variance accepted, not rewritten

- **Hours.** Sheet sums to 116.75; commercial figure is 120. Sales confirmed 120 as final. Recorded as `spreadsheet.variance_hours: 3.25` with `hours_variance_accepted: true`. No line item was altered to close the gap.
- **Absorbed scope.** MOD-05A matrices, MOD-01 registers, MOD-17 quality matrix, Agent-Ready Scope §11.2 canonical artifacts, and §11.3 agent availability records were directed into scope without dedicated lines. Recorded as risk, not as a rewrite.
- **MOD-09 / MOD-10 boundary.** Both modules in scope; the seven-page canonical inventory is an enumeration of inclusions, not a duplicate effort count. No source text altered.

---

## PM Agent Hand-off Instructions

PM Agent reads this file at G0 alongside `DSM_Designs_Agent_Ready_Scope_v1_2.docx`.

### Read order

1. **Agent-Ready Scope v1.2** — requirement baseline. Module contracts, gates, RFIs, acceptance criteria, authority hierarchy (§11.1).
2. **This spec** — commercial and effort layer, FLAG-004 blocklist, sprint budgets, rewrite audit trail.

The Agent-Ready Scope §11.1 places approved human decisions above both documents and this spec's rewrite log records four such decisions. Where the two documents disagree on anything not listed in Rewrites Applied, raise a CONFLICT record and stop the affected module. Do not select.

### Fields available directly from frontmatter

`platform`, `plan_tier`, `project_type`, `current_website`, `target_launch_date`, `total_hours`, `total_cost_usd`, `design.tool`, `design.status`, `design.mockup_url`, `design.implementation_layer`, `flag_004_blocklist`, `internal_pm_email`, `webdesk_designer`, `webdesk_dev_lead`, `webdesk_qa_lead`.

### Still to be asked at G0

1. Credentials handoff protocol — which secure channel (1Password, vault, other)
2. GitHub repository URL
3. Product Add-Ons plugin — exact publisher, product, edition, version, license owner (RFI-017)
4. Elementor edition verification in staging — Free vs Pro (ELM-01, ELM-02)
5. Payment gateway sandbox credentials (RFI-023)
6. Kuehne + Nagel API access, documentation, and credentials owner (RFI-013)
7. Brand asset source-file locations
8. Catalog sample or export for DATA-01 (RFI-015)

Eight questions, not a hundred. Everything else is above or in the Agent-Ready Scope's RFI register (RFI-001 through RFI-028).

### FLAG-004 enforcement

Load `flag_004_blocklist` into runtime config before any outbound comms action. Two emails, one phone, six social handles, two domains, one contact form URL. **Never submit the client contact form.** All client communication routes through the Internal PM.

One unresolved entry: the third-party Canva design-services site linked from the client Contact page. Treat as blocked pending PM confirmation of ownership.

### Cascading skill loads

- `wordpress-woocommerce/SKILL.md` — platform is woocommerce
- `wordpress-woocommerce/projects/redesign/SKILL.md` — project_type is redesign
- `_spine/orchestrator/knowledge/outbound-comms-gate.md` — FLAG-004 enforcement
- Designer Agent HTML mockup standards are **not** required — design is closed. Do not load a design workstream.

### Gate mapping

`GATE-00` through `GATE-07` in the Agent-Ready Scope are the governing gates for this project and take precedence over the generic G0–G6 sequence. GATE-02 (design approval) is already satisfied — record the signed artifact and date at G0 rather than re-running it.

---

*Internal document. Not for client distribution.*
