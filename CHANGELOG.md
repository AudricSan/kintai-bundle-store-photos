# Changelog

Tous les changements notables de ce bundle sont documentés dans ce fichier.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.0.0/).
Le schéma de version (X.Y.Z, canaux alpha/beta/main) est décrit dans
`.github/workflows/release.yml`.

## [Unreleased]

### Changed

- Contrat de bundle versionné : le bundle n'utilise plus que les noms du contrat `kintai\Contract\…` du Core (requête, réponse, routes, middlewares, exceptions, droits, données du Core, services, vues et composants) et déclare `"kintai_contract": "^1.0"` dans `bundle.json` (`kintai_core.min` relevé à `0.3.6`, première version du Core qui fournit le contrat). Nouveau test `ContractUsageTest` : toute utilisation du Core hors contrat échoue, hormis 1 classe(s) propre(s) au bundle qui vivent encore dans le Core (extraction prévue).

### Added

- Contrat de bundle 1.11 : le bundle déclare lui-même ce qu'il apporte au Core (`navigation()`, `permissions()`, `storeFeatures()`) au lieu que le Core le connaisse à l'avance ; déclarations identiques à ce que le Core affichait pour ce bundle, rien ne change à l'écran. `bundle.json` demande désormais `"kintai_contract": "^1.11"` (Kintai Core avec les points d'extension et fournisseurs du contrat). Nouveau test `ContractDeclarationsTest` : chaque déclaration est comparée au repli historique du Core.
- Socle de tests PHPUnit (composer.json, phpunit.xml) et CI qui l'exécute contre le vrai Core : les tests que le Core faisait tourner sur une copie figée du bundle (fixtures 1.0.0) vivent désormais ici et testent le code réel.

### Changed

- Compatibilité avec la Content-Security-Policy stricte de Kintai (`script-src 'self' 'nonce-…'`, sans `'unsafe-inline'`) : les 8 attributs d'événements inline des vues (`onclick=`/`onchange=`/`onsubmit=`/`oninput=`) sont remplacés par des attributs `data-*` (`data-on-click`, `data-submit-on-change`, `data-confirm`… gérés par `csp-actions.js` du Core) et le `<script>` inline porte désormais le nonce de la requête (`csp_nonce()`, gardé par `function_exists` pour ne pas planter sur un Core plus ancien). Sans ce changement, les boutons, sélecteurs et confirmations de ces vues ne font plus rien sous la nouvelle politique, sans aucune erreur visible. **Nécessite Kintai Core 0.3.0 ou plus** (`kintai_core.min`), version qui introduit `csp-actions.js` et la CSP à nonce. `tests.yml` échoue désormais si un handler inline, un lien `javascript:` ou un `<script>` sans nonce réapparaît dans `Views/` ou `src/`.

### Changed

- Aucun changement fonctionnel — bump de version pour aligner ce bundle sur la ligne 1.1.0 commune à tous les bundles officiels. Le bug d'affichage des photos inter-magasins signalé récemment vient du Core de Kintai (`PermissionMiddleware`), pas de ce bundle — voir `AudricSan/Kintai#65`.
- Le CSS (`.photo-*`, liste/détail/carrousel) et le JS du carrousel (`photo-carousel.js`) vivaient dans Kintai Core. Ils vivent maintenant dans `public/css/photos.css`/`public/js/photo-carousel.js`, fournis par ce bundle via `Bundle::loadAssetsFrom()`/`bundle_asset()`. Les règles génériques `.progress-bar*`/`.card` (aussi utilisées nativement par le Core, ex. `/admin/bundles/market`) restent des composants Core partagés, pas migrées. **Nécessite** `kintai_core.min: "0.2.0"`.

## [1.0.0] - 2026-09-19

### Added

- Extraction initiale depuis Kintai (`src/Bundles/StorePhoto`).
