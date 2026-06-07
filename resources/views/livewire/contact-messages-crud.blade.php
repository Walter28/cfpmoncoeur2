<div>
<div class="dash-container">

    <!-- Header -->
    <div class="dash-page-header">
        <div>
            <h4 class="dash-page-title">Messages de contact</h4>
            <p class="dash-page-subtitle">
                Messages reçus depuis le formulaire public
                @if($totalNonLus > 0)
                    — <span style="color:#7c3aed;font-weight:700;">{{ $totalNonLus }} non lu(s)</span>
                @endif
            </p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            @if($totalNonLus > 0)
            <button wire:click="marquerTousLus"
                    style="background:rgba(124,58,237,.1);color:#7c3aed;border:1px solid rgba(124,58,237,.2);border-radius:8px;padding:8px 16px;font-size:.8rem;font-weight:700;cursor:pointer;">
                <i class="bx bx-check-double me-1"></i>Tout marquer lu
            </button>
            @endif
            <div style="position:relative;">
                <i class="bx bx-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;"></i>
                <input wire:model.debounce.300ms="search" type="text" placeholder="Rechercher..."
                       style="border:1.5px solid #e5e7eb;border-radius:8px;padding:8px 12px 8px 36px;font-size:.85rem;outline:none;width:220px;"
                       onfocus="this.style.borderColor='#7c3aed'" onblur="this.style.borderColor='#e5e7eb'">
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="dash-card">
        <div class="dash-table-wrap">
            @if($messages->isEmpty())
                <div class="dash-empty-state">
                    <i class="bx bx-envelope"></i>
                    <p>Aucun message pour le moment</p>
                </div>
            @else
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Expéditeur</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $i => $msg)
                    <tr style="{{ !$msg->lu ? 'background:rgba(124,58,237,.03);' : '' }}">
                        <td><span class="dash-row-num">{{ $messages->firstItem() + $i }}</span></td>
                        <td>
                            <div class="dash-user-cell">
                                <div class="dash-avatar" style="background:linear-gradient(135deg,#7c3aed,#5b21b6);font-size:.7rem;">
                                    {{ strtoupper(substr($msg->nom,0,2)) }}
                                </div>
                                <div>
                                    <div class="dash-user-name" style="{{ !$msg->lu ? 'font-weight:800;' : '' }}">{{ $msg->nom }}</div>
                                    <div class="dash-user-sub">{{ $msg->email }}</div>
                                    @if($msg->telephone)
                                    <div class="dash-user-sub"><i class="bx bx-phone me-1"></i>{{ $msg->telephone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-size:.85rem;color:#374151;{{ !$msg->lu ? 'font-weight:700;' : '' }}">
                                {{ Str::limit($msg->sujet, 40) }}
                            </span>
                            <div style="font-size:.75rem;color:#9ca3af;margin-top:2px;">{{ Str::limit($msg->message, 60) }}</div>
                        </td>
                        <td class="dash-date-cell">
                            <i class="bx bx-calendar me-1"></i>
                            {{ $msg->created_at->format('d/m/Y') }}
                            <div style="font-size:.72rem;color:#9ca3af;">{{ $msg->created_at->format('H:i') }}</div>
                        </td>
                        <td>
                            @if($msg->lu)
                                <span class="dash-status-badge" style="background:rgba(107,114,128,.1);color:#6b7280;">Lu</span>
                            @else
                                <span class="dash-status-badge" style="background:rgba(124,58,237,.1);color:#7c3aed;">Nouveau</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <button wire:click="voir({{ $msg->id }})"
                                        style="background:rgba(6,187,204,.1);color:#06BBCC;border:none;border-radius:6px;padding:6px 10px;font-size:.78rem;cursor:pointer;"
                                        title="Lire le message">
                                    <i class="bx bx-show"></i>
                                </button>
                                <button wire:click="supprimer({{ $msg->id }})"
                                        onclick="return confirm('Supprimer ce message ?')"
                                        style="background:rgba(244,63,94,.1);color:#f43f5e;border:none;border-radius:6px;padding:6px 10px;font-size:.78rem;cursor:pointer;"
                                        title="Supprimer">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            <div style="padding:12px 16px;">
                {{ $messages->links() }}
            </div>
            @endif
        </div>
    </div>

</div>

<!-- Modal de lecture -->
@if($showModal && $selected)
<div style="position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;display:flex;align-items:center;justify-content:center;padding:16px;"
     wire:click.self="fermerModal">
    <div style="background:#fff;border-radius:20px;padding:32px;max-width:600px;width:100%;max-height:80vh;overflow-y:auto;box-shadow:0 20px 60px rgba(0,0,0,.2);">
        <!-- Header -->
        <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;">
            <div>
                <h5 style="font-family:'Nunito',sans-serif;font-weight:800;color:#181d38;margin-bottom:4px;">{{ $selected->sujet }}</h5>
                <span class="dash-status-badge" style="background:rgba(16,185,129,.1);color:#059669;">Message lu</span>
            </div>
            <button wire:click="fermerModal"
                    style="background:#f3f4f6;border:none;border-radius:8px;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#6b7280;">
                ✕
            </button>
        </div>

        <!-- Sender info -->
        <div style="background:#f8fafc;border-radius:12px;padding:16px;margin-bottom:20px;display:flex;align-items:center;gap:16px;">
            <div style="width:48px;height:48px;background:linear-gradient(135deg,#7c3aed,#5b21b6);border-radius:12px;display:flex;align-items:center;justify-content:center;color:#fff;font-family:'Nunito',sans-serif;font-weight:800;font-size:.9rem;flex-shrink:0;">
                {{ strtoupper(substr($selected->nom,0,2)) }}
            </div>
            <div>
                <div style="font-weight:800;color:#181d38;font-size:.95rem;">{{ $selected->nom }}</div>
                <div style="color:#6b7280;font-size:.82rem;margin-top:2px;">
                    <a href="mailto:{{ $selected->email }}" style="color:#06BBCC;text-decoration:none;">{{ $selected->email }}</a>
                    @if($selected->telephone)
                        &nbsp;·&nbsp;<a href="tel:{{ $selected->telephone }}" style="color:#06BBCC;text-decoration:none;">{{ $selected->telephone }}</a>
                    @endif
                </div>
                <div style="color:#9ca3af;font-size:.75rem;margin-top:2px;">
                    Reçu le {{ $selected->created_at->format('d/m/Y à H:i') }}
                </div>
            </div>
        </div>

        <!-- Message -->
        <div style="background:#fff;border:1.5px solid #e5e7eb;border-radius:12px;padding:20px;">
            <p style="color:#374151;line-height:1.8;margin:0;white-space:pre-line;">{{ $selected->message }}</p>
        </div>

        <!-- Actions -->
        <div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end;">
            <a href="mailto:{{ $selected->email }}?subject=Re: {{ $selected->sujet }}"
               style="background:linear-gradient(135deg,#06BBCC,#059aaa);color:#fff;border:none;border-radius:10px;padding:10px 20px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.875rem;text-decoration:none;display:inline-flex;align-items:center;gap:8px;">
                <i class="bx bx-reply"></i> Répondre par email
            </a>
            <button wire:click="fermerModal"
                    style="background:#f3f4f6;color:#374151;border:none;border-radius:10px;padding:10px 20px;font-family:'Nunito',sans-serif;font-weight:700;font-size:.875rem;cursor:pointer;">
                Fermer
            </button>
        </div>
    </div>
</div>
@endif

</div>
