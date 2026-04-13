@extends('admin.layout')

@section('title', 'Wedding Cards')
@section('page-title', 'Wedding Cards')
@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Dashboard</a> ›  Wedding Cards
@endsection

@section('content')

{{-- Stats Row --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.8rem;">
  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,var(--accent-border),transparent);"></div>
    <div style="font-size:1.1rem;margin-bottom:0.7rem;">💍</div>
    <div style="font-family:var(--font-display);font-size:2rem;color:var(--white);line-height:1;">{{ $stats['total'] }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:0.3rem;">Total Cards</div>
  </div>
  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(76,175,130,0.4),transparent);"></div>
    <div style="font-size:1.1rem;margin-bottom:0.7rem;">✅</div>
    <div style="font-family:var(--font-display);font-size:2rem;color:var(--success);line-height:1;">{{ $stats['active'] }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:0.3rem;">Active</div>
  </div>
  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(224,92,92,0.4),transparent);"></div>
    <div style="font-size:1.1rem;margin-bottom:0.7rem;">⏸️</div>
    <div style="font-family:var(--font-display);font-size:2rem;color:var(--danger);line-height:1;">{{ $stats['inactive'] }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:0.3rem;">Inactive</div>
  </div>
  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(76,130,175,0.4),transparent);"></div>
    <div style="font-size:1.1rem;margin-bottom:0.7rem;">👥</div>
    <div style="font-family:var(--font-display);font-size:2rem;color:#4c82af;line-height:1;">{{ $stats['totalRsvp'] }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);margin-top:0.3rem;">Total RSVP</div>
  </div>
</div>

{{-- Search + Table --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
  <div style="font-family:var(--font-display);font-size:1.2rem;font-style:italic;color:var(--white);">All Cards</div>
  <div style="display:flex;gap:0.7rem;align-items:center;">
    {{-- Search --}}
    <div style="display:flex;align-items:center;gap:0.5rem;padding:0.5rem 0.9rem;background:var(--bg-card);border:1px solid var(--border);border-radius:10px;">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
      <input type="text" placeholder="Search couple..." oninput="filterTable(this.value)"
        style="background:none;border:none;outline:none;font-family:var(--font-body);font-size:0.78rem;font-weight:300;color:var(--white);width:160px;">
    </div>
    {{-- Status filter --}}
    <select onchange="filterStatus(this.value)"
      style="padding:0.5rem 0.85rem;background:var(--bg-card);border:1px solid var(--border);border-radius:10px;font-family:var(--font-body);font-size:0.75rem;color:rgba(255,255,255,0.4);outline:none;cursor:pointer;">
      <option value="">All Status</option>
      <option value="1">Active</option>
      <option value="0">Inactive</option>
    </select>
  </div>
</div>

<div class="table-wrap">
  <table id="cardsTable">
    <thead>
      <tr>
        <th>Couple</th>
        <th>Wedding Date</th>
        <th>Venue</th>
        <th>RSVP</th>
        <th>Wishes</th>
        <th>Status</th>
        <th>Card Link</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($cards as $card)
      <tr data-status="{{ $card->is_active ? '1' : '0' }}" data-name="{{ strtolower($card->groom_name . ' ' . $card->bride_name) }}">
        <td>
          <div style="display:flex;align-items:center;gap:0.8rem;">
            <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,rgba(200,169,110,0.3),rgba(200,169,110,0.1));border:1px solid var(--accent-border);display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;">💍</div>
            <div>
              <div style="font-weight:400;color:var(--white);font-size:0.82rem;">{{ $card->groom_name_card ?: $card->groom_name }} & {{ $card->bride_name_card ?: $card->bride_name }}</div>
              <div style="font-size:0.6rem;color:rgba(255,255,255,0.18);margin-top:0.05rem;">{{ $card->groom_name }} & {{ $card->bride_name }}</div>
              <div style="font-size:0.62rem;color:rgba(255,255,255,0.25);margin-top:0.1rem;">{{ $card->slug }}</div>
            </div>
          </div>
        </td>
        <td>{{ $card->wedding_date->format('d M Y') }}</td>
        <td style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $card->venue_name }}</td>
        <td>{{ $card->rsvp_responses_count ?? 0 }}</td>
        <td>{{ $card->wishes_count ?? 0 }}</td>
        <td>
          @if($card->is_active)
            <span class="badge badge-active"><span class="badge-dot"></span>Active</span>
          @else
            <span class="badge badge-inactive"><span class="badge-dot"></span>Inactive</span>
          @endif
        </td>
        <td>
          <button class="action-btn c" title="Copy link" onclick="copyLink('{{ $card->slug }}')">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
          </button>
        </td>
        <td>
          <div class="action-btns">
            <a href="{{ route('admin.cards.show', $card) }}" class="action-btn v" title="View details">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </a>
            <a href="{{ route('admin.cards.edit', $card) }}" class="action-btn e" title="Edit card">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <a href="{{ route('card.show', $card->slug) }}" target="_blank" class="action-btn v" title="Preview card" style="color:rgba(255,255,255,0.3);">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            </a>
            <form method="POST" action="{{ route('admin.cards.toggle', $card) }}" style="display:inline;">
              @csrf @method('PATCH')
              <button type="submit" class="action-btn {{ $card->is_active ? 'd' : 'c' }}" title="{{ $card->is_active ? 'Deactivate' : 'Activate' }}">
                @if($card->is_active)
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                @else
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                @endif
              </button>
            </form>
            <button class="action-btn d" title="Delete" onclick="confirmDelete({{ $card->id }},'{{ $card->groom_name }} & {{ $card->bride_name }}')">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            </button>
          </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="8" style="text-align:center;padding:3rem;color:rgba(255,255,255,0.2);">
          <div style="font-size:2rem;margin-bottom:0.8rem;opacity:0.3;">💍</div>
          No cards yet. <a href="{{ route('admin.cards.create') }}" style="color:var(--accent);">Create your first card →</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Pagination --}}
@if($cards->hasPages())
<div style="display:flex;justify-content:center;margin-top:1.5rem;">
  {{ $cards->links() }}
</div>
@endif

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Confirm Delete</div>
      <button class="modal-close" onclick="closeModal('deleteModal')">✕</button>
    </div>
    <div class="modal-body">
      <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7;">
        Delete <strong id="deleteCardName" style="color:var(--white);"></strong>?<br>
        This will permanently remove all RSVP responses and wishes.
      </p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('deleteModal')">Cancel</button>
      <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Card</button>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
function filterTable(val){
  document.querySelectorAll('#cardsTable tbody tr[data-name]').forEach(r=>{
    r.style.display=r.dataset.name.includes(val.toLowerCase())?'':'none';
  });
}
function filterStatus(val){
  document.querySelectorAll('#cardsTable tbody tr[data-status]').forEach(r=>{
    r.style.display=(!val||r.dataset.status===val)?'':'none';
  });
}
function copyLink(slug){
  navigator.clipboard.writeText(window.location.origin+'/card/'+slug)
    .then(()=>showToast('Card link copied! 📋'));
}
function confirmDelete(id,name){
  document.getElementById('deleteCardName').textContent=name;
  document.getElementById('deleteForm').action='/admin/cards/'+id;
  openModal('deleteModal');
}
</script>
@endsection