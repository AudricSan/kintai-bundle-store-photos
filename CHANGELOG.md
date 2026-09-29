# Changelog

Tous les changements notables de ce bundle sont documentés dans ce fichier.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/).
Le schéma de version (X.Y.Z, canaux alpha/beta/main) est décrit dans
`.github/workflows/release.yml`.

## [Unreleased]

### Changed

- Aucun changement fonctionnel — bump de version pour aligner ce bundle sur la ligne 1.1.0 commune à tous les bundles officiels. Le bug d'affichage des photos inter-magasins signalé récemment vient du Core de Kintai (`PermissionMiddleware`), pas de ce bundle — voir `AudricSan/Kintai#65`.
- Le CSS (`.photo-*`, liste/détail/carrousel) et le JS du carrousel (`photo-carousel.js`) vivaient dans Kintai Core. Ils vivent maintenant dans `public/css/photos.css`/`public/js/photo-carousel.js`, fournis par ce bundle via `Bundle::loadAssetsFrom()`/`bundle_asset()`. Les règles génériques `.progress-bar*`/`.card` (aussi utilisées nativement par le Core, ex. `/admin/bundles/market`) restent des composants Core partagés, pas migrées. **Nécessite** `kintai_core.min: "0.2.0"`.

## [1.0.0] - 2026-09-19

### Added

- Extraction initiale depuis Kintai (`src/Bundles/StorePhoto`).
