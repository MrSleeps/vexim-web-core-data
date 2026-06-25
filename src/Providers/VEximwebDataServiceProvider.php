<?php

namespace VEximweb\Core\Data\Providers;

use Illuminate\Support\ServiceProvider;
use VEximweb\Core\Data\Repositories\Interfaces\DomainAliasRepositoryInterface;
use VEximweb\Core\Data\Repositories\Interfaces\DomainRepositoryInterface;
use VEximweb\Core\Data\Repositories\Interfaces\EximUserRepositoryInterface;
use VEximweb\Core\Data\Repositories\Interfaces\SettingRepositoryInterface;
use VEximweb\Core\Data\Repositories\Interfaces\UserRepositoryInterface;
use VEximweb\Core\Data\Repositories\DomainAliasRepository;
use VEximweb\Core\Data\Repositories\DomainRepository;
use VEximweb\Core\Data\Repositories\EximUserRepository;
use VEximweb\Core\Data\Repositories\SettingRepository;
use VEximweb\Core\Data\Repositories\UserRepository;

class VEximwebDataServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind plugin repositories
        $this->bindRepositories();
        
        // Bind plugin Services
        $this->bindServices();
    }

    public function boot(): void
    {
        // Load migrations if you have them
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
    }
    
    /**
     * Bind all repositories to their interfaces.
     */
    protected function bindRepositories(): void
    {
        // User repository
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        
        // Domain repository
        $this->app->bind(
            DomainRepositoryInterface::class,
            DomainRepository::class
        );
        
        // Domain alias repository
        $this->app->bind(
            DomainAliasRepositoryInterface::class,
            DomainAliasRepository::class
        );
        
        // EximUser repository
        $this->app->bind(
            EximUserRepositoryInterface::class,
            EximUserRepository::class
        );
        
        // Setting repository (in case SettingsServiceProvider isn't loaded yet)
        if (!$this->app->bound(SettingRepositoryInterface::class)) {
            $this->app->bind(
                SettingRepositoryInterface::class,
                SettingRepository::class
            );
        }
    }
    
    /**
     * Bind all services to the container.
     */
    protected function bindServices(): void
    {
        // Add any service bindings here if needed in the future
        // For now, this is empty but kept for consistency
    }
}