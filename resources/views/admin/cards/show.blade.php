@extends('admin.layout')

@section('title', $card->groom_name . ' & ' . $card->bride_name)
@section('page-title', $card->groom_name . ' & ' . $card->bride_name)
@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Dashboard</a> ›
  <a href="{{ route('admin.cards.index') }}">Wedding Cards</a> ›
  {{ $card->groom_name }} & {{ $card->bride_name }}
@endsection

@section('topbar-actions')
<a href="{{ route('card.show', $card->slug) }}" target="_blank" class="topbar-btn-ghost">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
  Preview
</a>
<a href="{{ route('admin.cards.edit', $card) }}" class="topbar-btn">
  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
  Edit Card
</a>
@endsection

@section('content')

{{-- Top Summary Row --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.8rem;">
  <div class="panel" style="padding:1.2rem 1.4rem;">
    <div style="font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:0.5rem;">Wedding Date</div>
    <div style="font-family:var(--font-display);font-size:1.1rem;color:var(--white);">{{ $card->wedding_date->format('d M Y') }}</div>
    @if($card->hijri_date)<div style="font-size:0.65rem;color:rgba(255,255,255,0.25);margin-top:0.2rem;">{{ $card->hijri_date }}</div>@endif
  </div>
  <div class="panel" style="padding:1.2rem 1.4rem;">
    <div style="font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:0.5rem;">Attending</div>
    <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--success);line-height:1;">{{ $attending }}</div>
    <div style="font-size:0.65rem;color:rgba(255,255,255,0.25);margin-top:0.2rem;">guests confirmed</div>
  </div>
  <div class="panel" style="padding:1.2rem 1.4rem;">
    <div style="font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:0.5rem;">Declined</div>
    <div style="font-family:var(--font-display);font-size:1.8rem;color:var(--danger);line-height:1;">{{ $declined }}</div>
    <div style="font-size:0.65rem;color:rgba(255,255,255,0.25);margin-top:0.2rem;">cannot attend</div>
  </div>
  <div class="panel" style="padding:1.2rem 1.4rem;">
    <div style="font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.25);margin-bottom:0.5rem;">Status</div>
    <div style="margin-top:0.3rem;">
      @if($card->is_active)
        <span class="badge badge-active" style="font-size:0.75rem;padding:0.3rem 0.8rem;"><span class="badge-dot"></span>Active</span>
      @else
        <span class="badge badge-inactive" style="font-size:0.75rem;padding:0.3rem 0.8rem;"><span class="badge-dot"></span>Inactive</span>
      @endif
    </div>
    <form method="POST" action="{{ route('admin.cards.toggle', $card) }}" style="margin-top:0.7rem;">
      @csrf @method('PATCH')
      <button type="submit" class="btn btn-ghost btn-sm" style="font-size:0.6rem;padding:0.3rem 0.7rem;">
        {{ $card->is_active ? 'Deactivate' : 'Activate' }}
      </button>
    </form>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 320px;gap:1.5rem;align-items:start;">

  {{-- LEFT: RSVP + WISHES --}}
  <div style="display:flex;flex-direction:column;gap:1.4rem;">

    {{-- Card Link --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">🔗 Card Link</div>
        <button onclick="copyLink()" class="btn btn-ghost btn-sm">Copy Link</button>
      </div>
      <div style="padding:1rem 1.4rem;display:flex;align-items:center;gap:1rem;">
        <div style="flex:1;background:rgba(200,169,110,0.06);border:1px solid var(--accent-border);border-radius:8px;padding:0.8rem 1rem;font-size:0.78rem;color:var(--accent);word-break:break-all;" id="cardLink">
          {{ url('/card/' . $card->slug) }}
        </div>
        <a href="{{ route('card.show', $card->slug) }}" target="_blank" class="btn btn-ghost btn-sm" style="flex-shrink:0;">
          Open ↗
        </a>
      </div>
    </div>

    {{-- RSVP Responses --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">✅ RSVP Responses</div>
        <div style="font-size:0.68rem;color:rgba(255,255,255,0.3);">{{ $card->rsvpResponses->count() }} total</div>
      </div>
      @if($card->rsvpResponses->count() > 0)
      <table>
        <thead>
          <tr>
            <th>Guest Name</th>
            <th>Phone</th>
            <th>Response</th>
            <th>Pax</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($card->rsvpResponses as $rsvp)
          <tr>
            <td style="color:var(--white);font-weight:400;">{{ $rsvp->guest_name }}</td>
            <td>{{ $rsvp->phone ?? '—' }}</td>
            <td>
              @if($rsvp->attendance === 'yes')
                <span class="badge badge-active"><span class="badge-dot"></span>Attending</span>
              @else
                <span class="badge badge-inactive"><span class="badge-dot"></span>Declined</span>
              @endif
            </td>
            <td>{{ $rsvp->attendance === 'yes' ? $rsvp->pax : '—' }}</td>
            <td style="font-size:0.72rem;color:rgba(255,255,255,0.25);">{{ $rsvp->created_at->format('d M, H:i') }}</td>
            <td>
              <form method="POST" action="{{ route('admin.rsvp.destroy', $rsvp) }}">
                @csrf @method('DELETE')
                <button type="submit" class="action-btn d" title="Remove"
                  onclick="return confirm('Remove this RSVP?')">
                  <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div style="text-align:center;padding:3rem;color:rgba(255,255,255,0.2);">
        <div style="font-size:2rem;margin-bottom:0.5rem;opacity:0.3;">📭</div>
        <div style="font-size:0.8rem;">No RSVP responses yet</div>
      </div>
      @endif
    </div>

    {{-- Wishes Wall --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💌 Wishes Wall</div>
        <div style="font-size:0.68rem;color:rgba(255,255,255,0.3);">{{ $card->wishes->count() }} wishes</div>
      </div>
      @if($card->wishes->count() > 0)
      <div style="padding:0.8rem;">
        @foreach($card->wishes as $wish)
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:1rem;padding:1rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);border-radius:12px;margin-bottom:0.6rem;">
          <div style="flex:1;">
            <div style="font-size:0.72rem;font-weight:500;color:var(--accent);margin-bottom:0.3rem;">{{ $wish->guest_name }}</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);line-height:1.6;font-style:italic;">{{ $wish->message }}</div>
            <div style="font-size:0.6rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">{{ $wish->created_at->format('d M Y, H:i') }}</div>
          </div>
          <form method="POST" action="{{ route('admin.wishes.destroy', $wish) }}" style="flex-shrink:0;">
            @csrf @method('DELETE')
            <button type="submit" class="action-btn d" title="Remove wish"
              onclick="return confirm('Remove this wish?')">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg>
            </button>
          </form>
        </div>
        @endforeach
      </div>
      @else
      <div style="text-align:center;padding:3rem;color:rgba(255,255,255,0.2);">
        <div style="font-size:2rem;margin-bottom:0.5rem;opacity:0.3;">💬</div>
        <div style="font-size:0.8rem;">No wishes yet</div>
      </div>
      @endif
    </div>

  </div>{{-- end left --}}

  {{-- RIGHT: Card Details Summary --}}
  <div style="display:flex;flex-direction:column;gap:1.2rem;position:sticky;top:0;">

    {{-- Details --}}
    <div class="panel">
      <div class="panel-header"><div class="panel-title">Card Details</div></div>
      <div style="padding:1.2rem 1.4rem;">

        <div style="display:flex;flex-direction:column;gap:0.9rem;">
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Groom & Bride</div>
            <div style="font-size:0.85rem;color:var(--white);">{{ $card->groom_name }} & {{ $card->bride_name }}</div>
            @if($card->groom_name_card || $card->bride_name_card)
            <div style="font-size:0.7rem;color:rgba(255,255,255,0.3);margin-top:0.2rem;">On card: {{ $card->groom_name_card ?: $card->groom_name }} & {{ $card->bride_name_card ?: $card->bride_name }}</div>
            @endif
          </div>
          @if($card->groom_father)
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Groom's Parents</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);line-height:1.7;">{{ $card->groom_father }}<br>{{ $card->groom_mother }}</div>
          </div>
          @endif
          @if($card->bride_father)
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Bride's Parents</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);line-height:1.7;">{{ $card->bride_father }}<br>{{ $card->bride_mother }}</div>
          </div>
          @endif
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Date & Time</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);">{{ $card->wedding_date->format('l, d F Y') }}</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);">{{ $card->wedding_time }}</div>
          </div>
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Venue</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);line-height:1.6;">{{ $card->venue_name }}<br>{{ $card->venue_address }}</div>
          </div>
          @if($card->dress_code)
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Dress Code</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);">{{ $card->dress_code }}</div>
          </div>
          @endif
          @if($card->rsvp_deadline)
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">RSVP Deadline</div>
            <div style="font-size:0.8rem;color:rgba(255,255,255,0.55);">{{ $card->rsvp_deadline->format('d F Y') }}</div>
          </div>
          @endif
@if($card->tng_number || $card->bank_number || $card->qr_image)
          <div>
            <div style="font-size:0.55rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(255,255,255,0.2);margin-bottom:0.3rem;">Digital Gift</div>
            @if($card->tng_number)<div style="font-size:0.78rem;color:rgba(255,255,255,0.5);">💚 TnG: {{ $card->tng_number }}</div>@endif
            @if($card->bank_number)<div style="font-size:0.78rem;color:rgba(255,255,255,0.5);">🏦 {{ $card->bank_name }}: {{ $card->bank_number }}</div>@endif
            @if($card->qr_image)
            <div style="margin-top:0.6rem;">
              <div style="font-size:0.7rem;color:rgba(255,255,255,0.3);margin-bottom:0.4rem;">📱 QR Code</div>
              <img src="{{ Storage::url($card->qr_image) }}"
                style="width:80px;height:80px;object-fit:contain;border-radius:8px;background:white;padding:4px;border:1px solid rgba(255,255,255,0.1);">
            </div>
            @endif
          </div>
          @endif
        </div>

        <div style="margin-top:1.2rem;padding-top:1.2rem;border-top:1px solid var(--border);">
          <a href="{{ route('admin.cards.edit', $card) }}" class="btn btn-ghost" style="width:100%;justify-content:center;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            Edit All Details
          </a>
        </div>
      </div>
    </div>

    {{-- RSVP Progress --}}
    <div class="panel">
      <div class="panel-header"><div class="panel-title">RSVP Progress</div></div>
      <div style="padding:1.2rem 1.4rem;">
        @php
          $total = $card->rsvpResponses->count();
          $attendPct = $total > 0 ? round(($attending / max($total,1)) * 100) : 0;
        @endphp
        <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:rgba(255,255,255,0.3);margin-bottom:0.5rem;">
          <span>Attending</span><span style="color:var(--success);">{{ $attending }} guests</span>
        </div>
        <div style="height:4px;background:rgba(255,255,255,0.06);border-radius:2px;overflow:hidden;margin-bottom:1rem;">
          <div style="height:100%;width:{{ $attendPct }}%;background:linear-gradient(to right,var(--success),rgba(76,175,130,0.4));border-radius:2px;transition:width 1s ease;"></div>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:rgba(255,255,255,0.3);margin-bottom:0.5rem;">
          <span>Declined</span><span style="color:var(--danger);">{{ $declined }}</span>
        </div>
        <div style="display:flex;justify-content:space-between;font-size:0.72rem;color:rgba(255,255,255,0.3);margin-top:0.8rem;padding-top:0.8rem;border-top:1px solid var(--border);">
          <span>Total Responses</span><span style="color:var(--white);">{{ $total }}</span>
        </div>
      </div>
    </div>

    {{-- Our Story Preview --}}
    @php $hasStory = $card->story_1_title || $card->story_2_title || $card->story_3_title || $card->story_4_title; @endphp
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💕 Our Story</div>
        <a href="{{ route('admin.cards.edit', $card) }}#story" style="font-size:0.65rem;color:var(--accent);text-decoration:none;">Edit →</a>
      </div>
      <div style="padding:1rem 1.4rem;">
        @if($hasStory)
          @foreach([1,2,3,4] as $i)
            @if($card->{"story_{$i}_title"})
            <div style="display:flex;gap:0.7rem;padding:0.6rem 0;border-bottom:1px solid rgba(255,255,255,0.04);">
              <div style="width:6px;height:6px;border-radius:50%;background:var(--accent);flex-shrink:0;margin-top:5px;opacity:0.6;"></div>
              <div>
                <div style="font-size:0.65rem;color:rgba(200,169,110,0.6);">{{ $card->{"story_{$i}_year"} }}</div>
                <div style="font-size:0.78rem;color:var(--white);font-weight:400;">{{ $card->{"story_{$i}_title"} }}</div>
              </div>
            </div>
            @endif
          @endforeach
        @else
          <div style="font-size:0.75rem;color:rgba(255,255,255,0.2);text-align:center;padding:1rem 0;">
            Using default story text.<br>
            <a href="{{ route('admin.cards.edit', $card) }}" style="color:var(--accent);font-size:0.7rem;">Add custom story →</a>
          </div>
        @endif
      </div>
    </div>

    {{-- Photos Preview --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">📸 Photos</div>
        <a href="{{ route('admin.cards.edit', $card) }}" style="font-size:0.65rem;color:var(--accent);text-decoration:none;">Edit →</a>
      </div>
      <div style="padding:0.8rem 1rem;display:grid;grid-template-columns:1fr 1fr 1fr;gap:0.5rem;">
        @foreach(['photo_1','photo_2','photo_3'] as $p)
        <div style="aspect-ratio:1;border-radius:8px;overflow:hidden;background:rgba(255,255,255,0.03);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;">
          @if($card->$p)
            <img src="{{ Storage::url($card->$p) }}" style="width:100%;height:100%;object-fit:cover;">
          @else
            <span style="font-size:1.2rem;opacity:0.2;">📷</span>
          @endif
        </div>
        @endforeach
      </div>
    </div>

  </div>{{-- end right --}}

</div>
@endsection

@section('scripts')
<script>
function copyLink(){
  navigator.clipboard.writeText(document.getElementById('cardLink').textContent.trim())
    .then(()=>showToast('Card link copied! 📋'));
}
</script>
@endsection