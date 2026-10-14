<?php

declare(strict_types=1);

namespace kintai\Bundles\Installed\StorePhoto;

use kintai\Contract\Bundle;
use kintai\Contract\Extension\NavItem;
use kintai\Contract\Extension\StoreFeature;

/**
 * Contrairement à sa version legacy, ce bundle n'enregistre plus son propre
 * repository : StorePhotoRepositoryInterface reste un service Core
 * (RepositoryServiceProvider), car GithubUpdateService et le script CLI
 * consolidate-daily-photo-reports.php en dépendent directement — ils doivent
 * continuer de fonctionner même si ce bundle est désactivé ou désinstallé.
 * StorePhotoConsolidationService, utilisé par ces deux consommateurs Core,
 * vit désormais dans les services du Core pour la même raison. Désactiver
 * "store-photos" retire uniquement l'UI d'envoi/consultation des photos, pas
 * les données elles-mêmes ni le rattrapage de consolidation.
 */
final class StorePhotoBundle extends Bundle
{
    public function getName(): string
    {
        return 'store-photos';
    }

    public function getVersion(): string
    {
        return '1.2.0';
    }

    public function getLabel(): string
    {
        return __('bundle_store_photos');
    }

    public function getDescription(): string
    {
        return __('bundle_store_photos_desc');
    }

    public function register(): void
    {
        $this->loadViewsFrom($this->getPath() . '/Views', 'store-photos');
        $this->loadRoutesFrom($this->getPath() . '/routes.php');
        $this->loadAssetsFrom('public');
    }

    /**
     * Navigation (contrat 1.1) : entrée(s) de la barre du haut et de la barre mobile.
     */
    public function navigation(): array
    {
        return [
            new NavItem('photos', NavItem::REPORTS, 'photos', 'admin.photos.index', 'admin.photos.index',
                icon: 'camera', activePaths: ['/admin/photos'], storeFeature: 'photos', order: 60),
        ];
    }

    /**
     * Catégories de permissions (contrat 1.2), proposées sur la page des rôles.
     */
    public function permissions(): array
    {
        return ['photos' => ['view', 'create', 'update', 'delete']];
    }

    /**
     * Fonctionnalité activable par magasin (contrat 1.3), sur la fiche magasin.
     */
    public function storeFeatures(): array
    {
        return [new StoreFeature('photos', 'feature_photos', 'feature_photos_desc', '📷', 80)];
    }
}
