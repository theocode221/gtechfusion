@extends('admin.layout')

@section('title', 'Edit — ' . $card->groom_name . ' & ' . $card->bride_name)
@section('page-title', 'Edit Card')
@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Dashboard</a> ›
  <a href="{{ route('admin.cards.index') }}">Wedding Cards</a> ›
  <a href="{{ route('admin.cards.show', $card) }}">{{ $card->groom_name }} & {{ $card->bride_name }}</a> ›
  Edit
@endsection

@section('topbar-actions')
<a href="{{ route('admin.cards.show', $card) }}" class="topbar-btn-ghost">← Back to Card</a>
@endsection

@section('extra-styles')
<style>
.upload-box{border:1.5px dashed rgba(200,169,110,0.25);border-radius:12px;padding:0.5rem;cursor:pointer;transition:border-color 0.25s,background 0.25s;background:rgba(200,169,110,0.02);min-height:140px;display:flex;align-items:center;justify-content:center;}
.upload-box:hover{border-color:rgba(200,169,110,0.55);background:rgba(200,169,110,0.04);}
.upload-box-sm{min-height:110px;}
.upload-preview{width:100%;height:100%;min-height:inherit;display:flex;align-items:center;justify-content:center;border-radius:10px;overflow:hidden;}
.upload-placeholder{display:flex;flex-direction:column;align-items:center;gap:0.4rem;color:rgba(255,255,255,0.22);font-size:0.72rem;text-align:center;padding:1rem;}
.upload-placeholder span:first-child{font-size:1.6rem;opacity:0.5;}
.story-chapter{padding:1rem 1.1rem;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.05);border-radius:12px;margin-bottom:0.8rem;transition:border-color 0.2s;}
.story-chapter:hover{border-color:rgba(200,169,110,0.15);}
.story-chapter-label{font-size:0.58rem;letter-spacing:0.2em;text-transform:uppercase;color:rgba(200,169,110,0.55);margin-bottom:0.75rem;}
</style>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.cards.update', $card) }}" id="cardForm" enctype="multipart/form-data">
@csrf @method('PUT')

<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">

  {{-- ═══ LEFT COLUMN ═══ --}}
  <div style="display:flex;flex-direction:column;gap:1.2rem;">

    {{-- ── Couple Info ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💍 Couple Information</div>
      </div>
      <div class="panel-body">

        <div class="form-section-label">Full Names (for invitation text)</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Groom Full Name <span>*</span></label>
            <input type="text" name="groom_name" class="form-input"
              value="{{ old('groom_name', $card->groom_name) }}"
              placeholder="e.g. Amir Hafizi bin Ahmad" required>
            <div class="form-hint">Appears in invitation section</div>
            @error('groom_name')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.2rem;">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Bride Full Name <span>*</span></label>
            <input type="text" name="bride_name" class="form-input"
              value="{{ old('bride_name', $card->bride_name) }}"
              placeholder="e.g. Syahira binti Zulkifli" required>
            <div class="form-hint">Appears in invitation section</div>
            @error('bride_name')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.2rem;">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-section-label">Names on Card (shown on cover & closing)</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Groom Name on Card</label>
            <input type="text" name="groom_name_card" class="form-input"
              value="{{ old('groom_name_card', $card->groom_name_card) }}"
              placeholder="e.g. Amir">
            <div class="form-hint">Short name — leave blank to use full name</div>
          </div>
          <div class="form-group">
            <label class="form-label">Bride Name on Card</label>
            <input type="text" name="bride_name_card" class="form-input"
              value="{{ old('bride_name_card', $card->bride_name_card) }}"
              placeholder="e.g. Syahira">
            <div class="form-hint">Short name — leave blank to use full name</div>
          </div>
        </div>

        <div class="form-section-label">Groom's Parents</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Father's Name</label>
            <input type="text" name="groom_father" class="form-input"
              value="{{ old('groom_father', $card->groom_father) }}"
              placeholder="Encik Ahmad bin Hassan">
          </div>
          <div class="form-group">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="groom_mother" class="form-input"
              value="{{ old('groom_mother', $card->groom_mother) }}"
              placeholder="Puan Rohani binti Yusof">
          </div>
        </div>

        <div class="form-section-label">Bride's Parents</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Father's Name</label>
            <input type="text" name="bride_father" class="form-input"
              value="{{ old('bride_father', $card->bride_father) }}"
              placeholder="Encik Rahim bin Ismail">
          </div>
          <div class="form-group">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="bride_mother" class="form-input"
              value="{{ old('bride_mother', $card->bride_mother) }}"
              placeholder="Puan Norzila binti Abdullah">
          </div>
        </div>

      </div>
    </div>

    {{-- ── Event Details ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">📅 Event Details</div>
      </div>
      <div class="panel-body">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Wedding Date <span>*</span></label>
            <input type="date" name="wedding_date" id="weddingDate" class="form-input"
              value="{{ old('wedding_date', $card->wedding_date->format('Y-m-d')) }}" required>
          </div>
          <div class="form-group">
            <label class="form-label">Hijri Date</label>
            <input type="text" name="hijri_date" id="hijriDate" class="form-input"
              value="{{ old('hijri_date', $card->hijri_date) }}"
              placeholder="Auto-filled when date changed">
            <div class="form-hint">Auto-calculated — you can edit manually</div>
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Wedding Time <span>*</span></label>
            <input type="text" name="wedding_time" class="form-input"
              value="{{ old('wedding_time', $card->wedding_time) }}"
              placeholder="11:00 AM — 4:00 PM" required>
          </div>
          <div class="form-group">
            <label class="form-label">RSVP Deadline</label>
            <input type="date" name="rsvp_deadline" class="form-input"
              value="{{ old('rsvp_deadline', optional($card->rsvp_deadline)->format('Y-m-d')) }}">
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Venue Name <span>*</span></label>
            <input type="text" name="venue_name" class="form-input"
              value="{{ old('venue_name', $card->venue_name) }}" required>
          </div>
          <div class="form-group">
            <label class="form-label">Dress Code</label>
            <input type="text" name="dress_code" class="form-input"
              value="{{ old('dress_code', $card->dress_code) }}">
          </div>
        </div>
        <div class="form-grid cols-1">
          <div class="form-group">
            <label class="form-label">Venue Address <span>*</span></label>
            <input type="text" name="venue_address" class="form-input"
              value="{{ old('venue_address', $card->venue_address) }}" required>
          </div>
        </div>
        <div class="form-grid cols-1">
          <div class="form-group">
            <label class="form-label">Google Maps URL</label>
            <input type="url" name="maps_url" class="form-input"
              value="{{ old('maps_url', $card->maps_url) }}"
              placeholder="https://maps.google.com/...">
          </div>
        </div>
      </div>
    </div>

    {{-- ── Our Story ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💕 Our Story</div>
      </div>
      <div class="panel-body">
        <p style="font-size:0.72rem;color:rgba(255,255,255,0.3);margin-bottom:1.2rem;">Fill in your love story timeline. Leave empty to use default placeholder text.</p>

        @foreach([1,2,3,4] as $i)
        <div class="story-chapter">
          <div class="story-chapter-label">Chapter {{ $i }}</div>
          <div class="form-grid" style="grid-template-columns:130px 1fr;gap:0.8rem;margin-bottom:0.7rem;">
            <div class="form-group">
              <label class="form-label">Year / Label</label>
              <input type="text" name="story_{{ $i }}_year" class="form-input"
                value="{{ old('story_'.$i.'_year', $card->{'story_'.$i.'_year'}) }}"
                placeholder="{{ ['2019','2020','2022','2025'][$i-1] }}">
            </div>
            <div class="form-group">
              <label class="form-label">Title</label>
              <input type="text" name="story_{{ $i }}_title" class="form-input"
                value="{{ old('story_'.$i.'_title', $card->{'story_'.$i.'_title'}) }}"
                placeholder="{{ ['First Meeting ✨','Growing Together 🌿','The Proposal 💍','Forever Begins 🌸'][$i-1] }}">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="story_{{ $i }}_desc" class="form-textarea" rows="2"
              placeholder="Write your story here...">{{ old('story_'.$i.'_desc', $card->{'story_'.$i.'_desc'}) }}</textarea>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    {{-- ── Digital Gift ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">🎁 Digital Gift (Ang Pau)</div>
      </div>
      <div class="panel-body">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Touch 'n Go / eWallet Number</label>
            <input type="text" name="tng_number" class="form-input"
              value="{{ old('tng_number', $card->tng_number) }}">
          </div>
          <div class="form-group">
            <label class="form-label">Bank Name</label>
            <input type="text" name="bank_name" class="form-input"
              value="{{ old('bank_name', $card->bank_name) }}">
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Bank Account Number</label>
            <input type="text" name="bank_number" class="form-input"
              value="{{ old('bank_number', $card->bank_number) }}">
          </div>
          <div class="form-group">
            <label class="form-label">Account Holder Name</label>
            <input type="text" name="bank_holder" class="form-input"
              value="{{ old('bank_holder', $card->bank_holder) }}">
          </div>
        </div>

        {{-- QR Code --}}
        <div class="form-section-label" style="margin-top:0.8rem;">DuitNow / QR Code</div>
        <div class="form-group">
          <label class="form-label">QR Code Image</label>
          <div class="upload-box upload-box-sm" onclick="document.getElementById('qr').click()" style="max-width:220px;">
            <div class="upload-preview" id="qrPreview">
              @if($card->qr_image)
                <img src="{{ Storage::url($card->qr_image) }}"
                  style="width:100%;height:100%;object-fit:contain;border-radius:10px;background:white;padding:4px;">
              @else
                <div class="upload-placeholder">
                  <span>📱</span>
                  <span>Click to upload QR</span>
                  <span style="font-size:0.62rem;opacity:0.5;">DuitNow / QR Pay</span>
                </div>
              @endif
            </div>
          </div>
          <input type="file" id="qr" name="qr_image" accept="image/*"
            style="display:none" onchange="previewPhoto(this,'qrPreview')">
          @if($card->qr_image)
          <div style="font-size:0.62rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">✓ Current QR saved — upload new to replace</div>
          @endif
          <div class="form-hint">Upload your DuitNow or bank QR code image</div>
          @error('qr_image')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

      </div>
    </div>

    {{-- ── Prewedding Photos ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">📸 Prewedding Photos</div>
      </div>
      <div class="panel-body">
        <p style="font-size:0.72rem;color:rgba(255,255,255,0.3);margin-bottom:1.1rem;">
          Max 256MB per photo · JPG, PNG, WEBP · Leave empty to keep existing photo
        </p>

        {{-- Photo 1 --}}
        <div class="form-group" style="margin-bottom:1rem;">
          <label class="form-label">Photo 1 — Main Banner (landscape)</label>
          <div class="upload-box" onclick="document.getElementById('p1').click()">
            <div class="upload-preview" id="p1Preview">
              @if($card->photo_1)
                <img src="{{ Storage::url($card->photo_1) }}"
                  style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
              @else
                <div class="upload-placeholder">
                  <span>🌸</span>
                  <span>Click to upload Photo 1</span>
                  <span style="font-size:0.62rem;opacity:0.5;">Recommended: 16:9 · landscape</span>
                </div>
              @endif
            </div>
          </div>
          <input type="file" id="p1" name="photo_1" accept="image/*"
            style="display:none" onchange="previewPhoto(this,'p1Preview')">
          @if($card->photo_1)
          <div style="font-size:0.62rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">
            ✓ Current photo saved — upload new to replace
          </div>
          @endif
          @error('photo_1')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        {{-- Photo 2 & 3 --}}
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Photo 2 (portrait)</label>
            <div class="upload-box upload-box-sm" onclick="document.getElementById('p2').click()">
              <div class="upload-preview" id="p2Preview">
                @if($card->photo_2)
                  <img src="{{ Storage::url($card->photo_2) }}"
                    style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                @else
                  <div class="upload-placeholder"><span>🌿</span><span>Click to upload</span></div>
                @endif
              </div>
            </div>
            <input type="file" id="p2" name="photo_2" accept="image/*"
              style="display:none" onchange="previewPhoto(this,'p2Preview')">
            @if($card->photo_2)
            <div style="font-size:0.62rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">✓ Current photo saved</div>
            @endif
            @error('photo_2')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Photo 3 (portrait)</label>
            <div class="upload-box upload-box-sm" onclick="document.getElementById('p3').click()">
              <div class="upload-preview" id="p3Preview">
                @if($card->photo_3)
                  <img src="{{ Storage::url($card->photo_3) }}"
                    style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                @else
                  <div class="upload-placeholder"><span>💐</span><span>Click to upload</span></div>
                @endif
              </div>
            </div>
            <input type="file" id="p3" name="photo_3" accept="image/*"
              style="display:none" onchange="previewPhoto(this,'p3Preview')">
            @if($card->photo_3)
            <div style="font-size:0.62rem;color:rgba(255,255,255,0.2);margin-top:0.4rem;">✓ Current photo saved</div>
            @endif
            @error('photo_3')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
          </div>
        </div>

      </div>
    </div>

  </div>{{-- end left --}}

  {{-- ═══ RIGHT SIDEBAR ═══ --}}
  <div style="display:flex;flex-direction:column;gap:1.2rem;position:sticky;top:0;">

    {{-- Publish --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">Publish Settings</div>
      </div>
      <div class="panel-body">
        <div class="form-group" style="margin-bottom:1.2rem;">
          <label class="form-label">Status</label>
          <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active', $card->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>✅ Active — Visible to guests</option>
            <option value="0" {{ old('is_active', $card->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>⏸ Inactive — Hidden from guests</option>
          </select>
        </div>
        <div class="form-group" style="margin-bottom:1.2rem;">
          <label class="form-label">Background Music URL</label>
          <input type="url" name="music_url" class="form-input"
            value="{{ old('music_url', $card->music_url) }}"
            placeholder="https://...mp3">
        </div>
        <div style="display:flex;flex-direction:column;gap:0.6rem;">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Save Changes
          </button>
          <a href="{{ route('admin.cards.show', $card) }}" class="btn btn-ghost" style="width:100%;justify-content:center;">
            Cancel
          </a>
        </div>
      </div>
    </div>

    {{-- Card URL --}}
    <div class="panel">
      <div class="panel-header"><div class="panel-title">Card URL</div></div>
      <div class="panel-body">
        <div style="background:rgba(200,169,110,0.06);border:1px solid var(--accent-border);border-radius:8px;padding:0.8rem;font-size:0.72rem;color:var(--accent);word-break:break-all;margin-bottom:0.8rem;">
          {{ url('/card/' . $card->slug) }}
        </div>
        <a href="{{ route('card.show', $card->slug) }}" target="_blank"
          class="btn btn-ghost btn-sm" style="width:100%;justify-content:center;">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
          Preview Card
        </a>
        <p style="font-size:0.6rem;color:rgba(255,255,255,0.15);margin-top:0.6rem;text-align:center;">Slug cannot be changed after creation</p>
      </div>
    </div>

    {{-- Tips --}}
    <div class="panel">
      <div class="panel-header"><div class="panel-title">💡 Tips</div></div>
      <div style="padding:1.2rem 1.4rem;">
        <div style="font-size:0.72rem;color:rgba(255,255,255,0.3);line-height:2;">
          ✦ <strong style="color:rgba(255,255,255,0.5);">Name on Card</strong> — use short/nickname only<br>
          ✦ <strong style="color:rgba(255,255,255,0.5);">Hijri Date</strong> — auto-fills when date changes<br>
          ✦ <strong style="color:rgba(255,255,255,0.5);">Our Story</strong> — leave blank for default text<br>
          ✦ <strong style="color:rgba(255,255,255,0.5);">Photos</strong> — leave empty to keep existing
        </div>
      </div>
    </div>

    {{-- Danger Zone --}}
    <div class="panel" style="border-color:rgba(224,92,92,0.15);">
      <div class="panel-header" style="border-color:rgba(224,92,92,0.1);">
        <div class="panel-title" style="color:var(--danger);">Danger Zone</div>
      </div>
      <div class="panel-body">
        <p style="font-size:0.72rem;color:rgba(255,255,255,0.3);margin-bottom:1rem;">Permanently delete this card and all its data.</p>
        <button type="button" class="btn btn-danger" style="width:100%;justify-content:center;"
          onclick="confirmDelete()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
          Delete This Card
        </button>
      </div>
    </div>

  </div>{{-- end right --}}

</div>
</form>

{{-- Delete Modal --}}
<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Confirm Delete</div>
      <button class="modal-close" onclick="closeModal('deleteModal')">✕</button>
    </div>
    <div class="modal-body">
      <p style="font-size:0.82rem;color:rgba(255,255,255,0.5);line-height:1.7;">
        Delete <strong style="color:var(--white);">{{ $card->groom_name }} & {{ $card->bride_name }}</strong>?<br>
        All RSVP responses ({{ $card->rsvpResponses->count() }}) and wishes ({{ $card->wishes->count() }}) will be permanently deleted.
      </p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-ghost" onclick="closeModal('deleteModal')">Cancel</button>
      <form method="POST" action="{{ route('admin.cards.destroy', $card) }}">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Yes, Delete</button>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
function confirmDelete(){openModal('deleteModal');}

// ── Auto Hijri Date ──
document.getElementById('weddingDate').addEventListener('change', function() {
  if (!this.value) return;
  try {
    const date = new Date(this.value + 'T12:00:00');
    const hijriMonths = ['Muharram','Safar','Rabiulawal','Rabiulakhir','Jamadilawal','Jamadilakhir','Rejab','Syaaban','Ramadan','Syawal','Zulkaedah','Zulhijjah'];
    const fmt = new Intl.DateTimeFormat('en-u-ca-islamic', {day:'numeric',month:'numeric',year:'numeric'});
    const parts = fmt.formatToParts(date);
    const hDay   = parts.find(p => p.type === 'day')?.value;
    const hMonth = parseInt(parts.find(p => p.type === 'month')?.value) - 1;
    const hYear  = parts.find(p => p.type === 'year')?.value;
    document.getElementById('hijriDate').value = `${hDay} ${hijriMonths[hMonth] ?? ''} ${hYear}H`;
  } catch(e) { console.warn('Hijri conversion failed:', e); }
});

// ── Photo preview ──
function previewPhoto(input, previewId) {
  if (!input.files || !input.files[0]) return;
  if (input.files[0].size > 256 * 1024 * 1024) {
    showToast('Photo must be under 256MB ⚠️', 'error');
    input.value = '';
    return;
  }
  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById(previewId).innerHTML =
      `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:10px;display:block;">`;
  };
  reader.readAsDataURL(input.files[0]);
}
</script>
@endsection