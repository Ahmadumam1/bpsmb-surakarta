<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\RequestPasswordReset;
use App\Filament\Pages\ChangePassword;
use App\Filament\Pages\TwoFactorAuthentication;
use App\Http\Middleware\EnsurePasswordIsNotExpired;
use App\Http\Middleware\EnsureTwoFactorAuthenticated;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use App\Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->passwordReset(RequestPasswordReset::class)
            ->brandName('BPSMB Surakarta')
            ->brandLogo(fn() => new HtmlString('
                <span style="display: inline-flex; align-items: center; gap: 10px; height: 100%; white-space: nowrap;">
                    <img src="' . e(asset('assets/logo2.png')) . '" alt="Logo BPSMB Surakarta" style="height: 38px; width: auto; object-fit: contain; flex-shrink: 0;">
                    <span class="fi-brand-text" style="font-size: 20px; font-weight: 600; line-height: 1;">BPSMB Surakarta</span>
                </span>
            '))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('assets/logo2.png'))
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->icons([
                'panels::sidebar.collapse-button' => 'heroicon-o-chevron-double-left',
                'panels::sidebar.expand-button' => 'heroicon-o-chevron-double-right',
                'panels::topbar.open-sidebar-button' => 'heroicon-o-bars-3-bottom-left',
                'panels::topbar.close-sidebar-button' => 'heroicon-o-x-mark',
            ])
            ->renderHook(
                PanelsRenderHook::SIMPLE_LAYOUT_START,
                fn() => new HtmlString('
                    <style>
                        /* === Layout Utama (Desktop & Mobile) === */
                        .fi-simple-layout {
                            min-height: 100vh;
                            width: 100%;
                            background:
                                linear-gradient(135deg, rgba(5, 46, 38, 0.92), rgba(15, 23, 42, 0.72)),
                                url("' . e(asset('assets/bg.jpg')) . '");
                            background-position: center;
                            background-size: cover;
                            background-attachment: fixed;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            padding: 1rem;
                            box-sizing: border-box;
                        }

                        /* Force Brand Text di Login Page agar selalu Hitam (Desktop & Mobile) */
                        .fi-simple-layout .fi-brand-text {
                            color: #000000 !important;
                        }

                        /* Hapus/Sembunyikan text Sign in / Judul Halaman */
                        .fi-simple-header-heading {
                            display: none !important;
                        }

                        /* === Kustomisasi Khusus Mobile (max-width: 640px) === */
                        @media (max-width: 640px) {
                            .fi-simple-layout {
                                padding: 0.75rem;
                                align-items: flex-start;
                                padding-top: max(1.5rem, env(safe-area-inset-top));
                                padding-bottom: max(1.5rem, env(safe-area-inset-bottom));
                            }

                            .fi-simple-main {
                                max-width: 100%;
                            }

                            /* Membuat pojok card utama melengkung halus di mobile */
                            .fi-simple-main,
                            .fi-simple-card,
                            .fi-simple-main > *,
                            .fi-simple-main > * > * {
                                border-radius: 20px !important;
                                overflow: hidden !important;
                            }

                            /* Pastikan elemen form dalam card tidak kotak */
                            .fi-simple-layout .fi-card,
                            .fi-simple-layout [class*="rounded-none"] {
                                border-radius: 20px !important;
                            }

                            .fi-simple-card {
                                padding: 1.25rem !important;
                                overflow: hidden;
                            }

                            /* Input lebih besar di mobile supaya mudah diklik */
                            .fi-input {
                                font-size: 1rem !important;
                                min-height: 2.75rem !important;
                            }

                            /* Tombol login lebih besar di mobile */
                            .fi-btn {
                                min-height: 2.75rem !important;
                                font-size: 0.9375rem !important;
                            }
                        }
                    </style>
                '),
                [Login::class, RequestPasswordReset::class],
            )

            ->renderHook(
                PanelsRenderHook::AUTH_PASSWORD_RESET_REQUEST_FORM_AFTER,
                fn() => new HtmlString('
                    <div style="margin-top: 1rem; text-align: center;">
                        <a
                            href="' . e(route('filament.admin.auth.login')) . '"
                            style="color: #d97706; font-size: 0.875rem; font-weight: 500; text-decoration: none;"
                        >
                            Back to login
                        </a>
                    </div>
                '),
                RequestPasswordReset::class,
            )
            ->renderHook(
                PanelsRenderHook::SIMPLE_LAYOUT_START,
                fn() => new HtmlString('
                    <style>
                        .fi-simple-header-heading {
                            font-size: 1.5rem;
                            line-height: 1.25;
                        }
                    </style>
                '),
                RequestPasswordReset::class,
            )
            ->renderHook(
                PanelsRenderHook::BODY_START,
                fn() => new HtmlString('
                    <style>
                        /* 1. Kustomisasi Sidebar (.fi-sidebar) - Soft Indigo Tint in Light Mode */
                        .fi-sidebar {
                            background-color: #f5f6ff !important; /* Soft Indigo Tint */
                            border-right: 1px solid rgba(199, 210, 254, 0.6) !important;
                        }
                        .fi-sidebar-header {
                            background-color: #ebeeff !important; /* Slightly darker indigo tint */
                            border-bottom: 1px solid rgba(199, 210, 254, 0.6) !important;
                        }
                        /* Brand/Logo text */
                        .fi-brand-text {
                            color: #000000 !important; /* Black in Light Mode */
                        }
                        .dark .fi-brand-text {
                            color: #ffffff !important; /* White in Dark Mode */
                        }
                        /* Group menu labels */
                        .fi-sidebar-group-label, .fi-sidebar-group-header {
                            color: #4f46e5 !important; /* Indigo-600 */
                        }
                        /* Navigation link elements */
                        .fi-sidebar-item a, .fi-sidebar-item button {
                            color: #334155 !important; /* Slate-700 */
                            transition: all 0.2s ease-in-out !important;
                            border-radius: 10px !important;
                        }
                        .fi-sidebar-item svg, .fi-sidebar-item-icon {
                            color: #6366f1 !important; /* Indigo-500 */
                            transition: all 0.2s ease-in-out !important;
                        }
                        /* Link Hover effect */
                        .fi-sidebar-item:hover a, .fi-sidebar-item:hover button {
                            background-color: rgba(79, 70, 229, 0.08) !important;
                            color: #4f46e5 !important;
                        }
                        .fi-sidebar-item:hover svg, .fi-sidebar-item:hover .fi-sidebar-item-icon {
                            color: #4f46e5 !important;
                        }
                        /* Active/Selected link */
                        .fi-sidebar-item.fi-active a, .fi-sidebar-item.fi-active button {
                            background-color: #4f46e5 !important; /* Indigo accent */
                            color: #ffffff !important;
                        }
                        .fi-sidebar-item.fi-active .fi-sidebar-item-label,
                        .fi-sidebar-item.fi-active span {
                            color: #ffffff !important;
                        }
                        .fi-sidebar-item.fi-active svg, .fi-sidebar-item.fi-active .fi-sidebar-item-icon {
                            color: #ffffff !important;
                        }

                        /* Dark Mode Overrides for Sidebar */
                        .dark .fi-sidebar {
                            background-color: #0f172a !important;
                            border-right: 1px solid rgba(51, 65, 85, 0.4) !important;
                        }
                        .dark .fi-sidebar-header {
                            background-color: #0c1322 !important;
                            border-bottom: 1px solid rgba(51, 65, 85, 0.4) !important;
                        }
                        .dark .fi-sidebar-header span, .dark .fi-sidebar-header a {
                            color: #ffffff !important;
                        }
                        .dark .fi-sidebar-group-label, .dark .fi-sidebar-group-header {
                            color: #94a3b8 !important;
                        }
                        .dark .fi-sidebar-item a, .dark .fi-sidebar-item button {
                            color: #cbd5e1 !important;
                        }
                        .dark .fi-sidebar-item svg, .dark .fi-sidebar-item-icon {
                            color: #94a3b8 !important;
                        }
                        .dark .fi-sidebar-item:hover a, .dark .fi-sidebar-item:hover button {
                            background-color: rgba(255, 255, 255, 0.06) !important;
                            color: #ffffff !important;
                        }
                        .dark .fi-sidebar-item:hover svg, .dark .fi-sidebar-item:hover .fi-sidebar-item-icon {
                            color: #ffffff !important;
                        }

                        /* 2. Kustomisasi Header & Topbar (.fi-header & .fi-topbar) */
                        .fi-topbar {
                            background-color: rgba(255, 255, 255, 0.85) !important;
                            backdrop-filter: blur(12px) !important;
                            border-bottom: 1px solid rgba(226, 232, 240, 0.8) !important;
                        }
                        .dark .fi-topbar {
                            background-color: rgba(15, 23, 42, 0.8) !important;
                            border-bottom: 1px solid rgba(51, 65, 85, 0.4) !important;
                        }   

                        /* Sembunyikan Judul "Dashboard" & Header Area pada Halaman Dashboard */
                        .fi-p-dashboard .fi-header {
                            display: none !important;
                        }

                        /* 3. Kustomisasi Body / Main Layout (.fi-main & body) */
                        .fi-main, body, .fi-layout {
                            background-color: #f1f5f9 !important;
                        }
                        .dark .fi-main, .dark body, .dark .fi-layout {
                            background-color: #090d16 !important;
                        }
                        .fi-main {
                            padding: 2rem !important;
                        }

                        /* 4. Kustomisasi Kartu Widget Grafik */
                        .fi-wi-chart {
                            border: 1px solid rgba(226, 232, 240, 0.7) !important;
                            border-radius: 16px !important;
                            background-color: #ffffff !important;
                            box-shadow: 0 4px 15px -3px rgba(148, 163, 184, 0.12) !important;
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }
                        .dark .fi-wi-chart {
                            border: 1px solid rgba(51, 65, 85, 0.3) !important;
                            background-color: rgba(30, 41, 59, 0.3) !important;
                            box-shadow: none !important;
                        }
                        .fi-wi-chart:hover {
                            transform: translateY(-4px) !important;
                            box-shadow: 0 12px 20px -8px rgba(79, 70, 229, 0.25) !important;
                            border-color: rgba(79, 70, 229, 0.4) !important;
                        }

                        /* 5. Kustomisasi Kartu Statistik (Stats Overview) */
                        .fi-wi-stats-overview-stat {
                            border-radius: 16px !important;
                            border: 1px solid transparent !important;
                            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
                            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        }
                        .fi-wi-stats-overview-stat:hover {
                            transform: translateY(-4px) !important;
                            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
                        }

                        /* Card 1: Total Foto (Info/Blue) */
                        .fi-wi-stats-overview-stat:nth-child(1) {
                            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%) !important;
                            border: 1px solid rgba(2, 132, 199, 0.15) !important;
                            border-left: 5px solid #0284c7 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-label {
                            color: #0369a1 !important;
                            font-weight: 600 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(1) svg {
                            color: #0284c7 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-value {
                            color: #0284c7 !important;
                            font-weight: 800 !important;
                        }

                        /* Card 2: Total Video (Warning/Amber) */
                        .fi-wi-stats-overview-stat:nth-child(2) {
                            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%) !important;
                            border: 1px solid rgba(217, 119, 6, 0.15) !important;
                            border-left: 5px solid #d97706 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-label {
                            color: #b45309 !important;
                            font-weight: 600 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(2) svg {
                            color: #d97706 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-value {
                            color: #d97706 !important;
                            font-weight: 800 !important;
                        }

                        /* Card 3: Total Berita (Danger/Red) */
                        .fi-wi-stats-overview-stat:nth-child(3) {
                            background: linear-gradient(135deg, #fff5f5 0%, #ffe3e3 100%) !important;
                            border: 1px solid rgba(224, 49, 49, 0.15) !important;
                            border-left: 5px solid #e03131 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-label {
                            color: #c92a2a !important;
                            font-weight: 600 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(3) svg {
                            color: #e03131 !important;
                        }
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-value {
                            color: #e03131 !important;
                            font-weight: 800 !important;
                        }

                        /* Dark Mode Support for Stats Cards */
                        .dark .fi-wi-stats-overview-stat:nth-child(1) {
                            background: linear-gradient(135deg, rgba(3, 105, 161, 0.25) 0%, rgba(2, 132, 199, 0.35) 100%) !important;
                            border: 1px solid rgba(2, 132, 199, 0.25) !important;
                            border-left: 5px solid #38bdf8 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-label {
                            color: #bae6fd !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(1) svg {
                            color: #38bdf8 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-value {
                            color: #38bdf8 !important;
                        }

                        .dark .fi-wi-stats-overview-stat:nth-child(2) {
                            background: linear-gradient(135deg, rgba(180, 83, 9, 0.25) 0%, rgba(217, 119, 6, 0.35) 100%) !important;
                            border: 1px solid rgba(217, 119, 6, 0.25) !important;
                            border-left: 5px solid #fbbf24 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-label {
                            color: #fde68a !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(2) svg {
                            color: #fbbf24 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-value {
                            color: #fbbf24 !important;
                        }

                        .dark .fi-wi-stats-overview-stat:nth-child(3) {
                            background: linear-gradient(135deg, rgba(201, 42, 42, 0.25) 0%, rgba(224, 49, 49, 0.35) 100%) !important;
                            border: 1px solid rgba(224, 49, 49, 0.25) !important;
                            border-left: 5px solid #f87171 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-label {
                            color: #ffc9c9 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(3) svg {
                            color: #f87171 !important;
                        }
                        .dark .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-value {
                            color: #f87171 !important;
                        }
                    </style>
                ')
            )
            ->sidebarWidth('18rem')
            ->collapsedSidebarWidth('4rem')
            ->sidebarFullyCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                ChangePassword::class,
                TwoFactorAuthentication::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                EnsurePasswordIsNotExpired::class,
                EnsureTwoFactorAuthenticated::class,
            ]);
    }
}
