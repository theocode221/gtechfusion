@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Grid --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.8rem;">

  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;transition:transform 0.3s,border-color 0.3s;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,var(--accent-border),transparent);"></div>
    <div style="width:36px;height:36px;border-radius:10px;background:var(--accent-dim);display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:0.9rem;">💍</div>
    <div style="font-family:var(--font-display);font-size:2.2rem;color:var(--white);line-height:1;margin-bottom:0.3rem;">{{ $totalCards }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);">Total Cards</div>
  </div>

  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(76,175,130,0.4),transparent);"></div>
    <div style="width:36px;height:36px;border-radius:10px;background:var(--success-dim);display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:0.9rem;">✅</div>
    <div style="font-family:var(--font-display);font-size:2.2rem;color:var(--success);line-height:1;margin-bottom:0.3rem;">{{ $activeCards }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);">Active Cards</div>
  </div>

  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(76,130,175,0.4),transparent);"></div>
    <div style="width:36px;height:36px;border-radius:10px;background:rgba(76,130,175,0.12);display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:0.9rem;">👥</div>
    <div style="font-family:var(--font-display);font-size:2.2rem;color:#4c82af;line-height:1;margin-bottom:0.3rem;">{{ $totalRsvp }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);">RSVP Responses</div>
  </div>

  <div class="panel" style="padding:1.3rem 1.4rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(to right,transparent,rgba(200,100,200,0.4),transparent);"></div>
    <div style="width:36px;height:36px;border-radius:10px;background:rgba(200,100,200,0.1);display:flex;align-items:center;justify-content:center;font-size:1rem;margin-bottom:0.9rem;">💌</div>
    <div style="font-family:var(--font-display);font-size:2.2rem;color:rgba(200,130,220,0.9);line-height:1;margin-bottom:0.3rem;">{{ $totalWishes }}</div>
    <div style="font-size:0.65rem;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.3);">Total Wishes</div>
  </div>

</div>

{{-- Bottom grid --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.4rem;">

  {{-- Recent Cards --}}
  <div class="panel">
    <div class="panel-header">
      <div class="panel-title">Recent Cards</div>
      <a href="{{ route('admin.cards.index') }}" style="font-size:0.68rem;color:var(--accent);text-decoration:none;">View all →</a>
    </div>
    @if($recentCards->count())
    <table>
      <thead>
        <tr>
          <th>Couple</th>
          <th>Date</th>
          <th>RSVP</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($recentCards as $card)
        <tr>
          <td>
            <div style="font-weight:400;color:var(--white);font-size:0.8rem;">{{ $card->groom_name }} & {{ $card->bride_name }}</div>
            <div style="font-size:0.6rem;color:rgba(255,255,255,0.2);">/card/{{ $card->slug }}</div>
          </td>
          <td style="font-size:0.75rem;">{{ $card->wedding_date->format('d M Y') }}</td>
          <td style="font-size:0.75rem;color:var(--success);">{{ $card->rsvp_responses_count }}</td>
          <td>
            @if($card->is_active)
              <span class="badge badge-active" style="font-size:0.6rem;"><span class="badge-dot"></span>Active</span>
            @else
              <span class="badge badge-inactive" style="font-size:0.6rem;"><span class="badge-dot"></span>Off</span>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.cards.show', $card) }}" class="action-btn v" title="View">
              <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div style="text-align:center;padding:3rem;color:rgba(255,255,255,0.2);">
      <div style="font-size:2rem;margin-bottom:0.5rem;opacity:0.3;">💍</div>
      <div style="font-size:0.8rem;">No cards yet.</div>
      <a href="{{ route('admin.cards.create') }}" style="color:var(--accent);font-size:0.78rem;">Create first card →</a>
    </div>
    @endif
  </div>

  {{-- Recent RSVP --}}
  <div class="panel">
    <div class="panel-header">
      <div class="panel-title">Recent RSVP</div>
      <a href="{{ route('admin.rsvp.index') }}" style="font-size:0.68rem;color:var(--accent);text-decoration:none;">View all →</a>
    </div>
    @if($recentRsvp->count())
    <div style="display:flex;flex-direction:column;">
      @foreach($recentRsvp as $rsvp)
      <div style="display:flex;align-items:center;gap:0.8rem;padding:0.85rem 1.2rem;border-bottom:1px solid rgba(255,255,255,0.03);">
        <div style="width:32px;height:32px;border-radius:50%;background:{{ $rsvp->attendance === 'yes' ? 'var(--success-dim)' : 'var(--danger-dim)' }};display:flex;align-items:center;justify-content:center;font-size:0.8rem;flex-shrink:0;">
          {{ $rsvp->attendance === 'yes' ? '✓' : '✗' }}
        </div>
        <div style="flex:1;min-width:0;">
          <div style="font-size:0.78rem;color:var(--white);font-weight:400;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $rsvp->guest_name }}</div>
          <div style="font-size:0.62rem;color:rgba(255,255,255,0.25);">{{ $rsvp->weddingCard->groom_name ?? '' }} & {{ $rsvp->weddingCard->bride_name ?? '' }}</div>
        </div>
        <div style="font-size:0.62rem;color:rgba(255,255,255,0.2);flex-shrink:0;">{{ $rsvp->created_at->diffForHumans() }}</div>
      </div>
      @endforeach
    </div>
    @else
    <div style="text-align:center;padding:3rem;color:rgba(255,255,255,0.2);">
      <div style="font-size:2rem;margin-bottom:0.5rem;opacity:0.3;">📭</div>
      <div style="font-size:0.8rem;">No RSVP responses yet</div>
    </div>
    @endif
  </div>

</div>
@endsection