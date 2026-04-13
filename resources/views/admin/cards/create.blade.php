@extends('admin.layout')

@section('title', 'Create Wedding Card')
@section('page-title', 'Create New Card')
@section('breadcrumb')
  <a href="{{ route('admin.dashboard') }}">Dashboard</a> ›
  <a href="{{ route('admin.cards.index') }}">Wedding Cards</a> ›
  Create
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

<form method="POST" action="{{ route('admin.cards.store') }}" id="cardForm" enctype="multipart/form-data">
@csrf

<div style="display:grid;grid-template-columns:1fr 340px;gap:1.5rem;align-items:start;">

  {{-- ═══ LEFT COLUMN ═══ --}}
  <div style="display:flex;flex-direction:column;gap:1.2rem;">

    {{-- ── Couple Info ── --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💍 Couple Information</div>
      </div>
      <div class="panel-body">

        {{-- Full names --}}
        <div class="form-section-label">Full Names (for invitation text)</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Groom Full Name <span>*</span></label>
            <input type="text" name="groom_name" class="form-input" value="{{ old('groom_name') }}"
              placeholder="e.g. Amir Hafizi bin Ahmad" required>
            <div class="form-hint">Appears in invitation section</div>
            @error('groom_name')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.2rem;">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Bride Full Name <span>*</span></label>
            <input type="text" name="bride_name" class="form-input" value="{{ old('bride_name') }}"
              placeholder="e.g. Syahira binti Zulkifli" required>
            <div class="form-hint">Appears in invitation section</div>
            @error('bride_name')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.2rem;">{{ $message }}</div>@enderror
          </div>
        </div>

        {{-- Short names on card --}}
        <div class="form-section-label">Names on Card (shown on cover & closing)</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Groom Name on Card</label>
            <input type="text" name="groom_name_card" class="form-input" value="{{ old('groom_name_card') }}"
              placeholder="e.g. Amir">
            <div class="form-hint">Short name for card cover — leave blank to use full name</div>
          </div>
          <div class="form-group">
            <label class="form-label">Bride Name on Card</label>
            <input type="text" name="bride_name_card" class="form-input" value="{{ old('bride_name_card') }}"
              placeholder="e.g. Syahira">
            <div class="form-hint">Short name for card cover — leave blank to use full name</div>
          </div>
        </div>

        {{-- Groom parents --}}
        <div class="form-section-label">Groom's Parents</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Father's Name</label>
            <input type="text" name="groom_father" class="form-input" value="{{ old('groom_father') }}"
              placeholder="Encik Ahmad bin Hassan">
          </div>
          <div class="form-group">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="groom_mother" class="form-input" value="{{ old('groom_mother') }}"
              placeholder="Puan Rohani binti Yusof">
          </div>
        </div>

        {{-- Bride parents --}}
        <div class="form-section-label">Bride's Parents</div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Father's Name</label>
            <input type="text" name="bride_father" class="form-input" value="{{ old('bride_father') }}"
              placeholder="Encik Rahim bin Ismail">
          </div>
          <div class="form-group">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="bride_mother" class="form-input" value="{{ old('bride_mother') }}"
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
              value="{{ old('wedding_date') }}" required>
          </div>
          <div class="form-group">
            <label class="form-label">Hijri Date</label>
            <input type="text" name="hijri_date" id="hijriDate" class="form-input"
              value="{{ old('hijri_date') }}" placeholder="Auto-filled when date is selected">
            <div class="form-hint">Auto-calculated — you can edit manually</div>
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Wedding Time <span>*</span></label>
            <input type="text" name="wedding_time" class="form-input" value="{{ old('wedding_time') }}"
              placeholder="e.g. 11:00 AM — 4:00 PM" required>
          </div>
          <div class="form-group">
            <label class="form-label">RSVP Deadline</label>
            <input type="date" name="rsvp_deadline" class="form-input" value="{{ old('rsvp_deadline') }}">
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Venue Name <span>*</span></label>
            <input type="text" name="venue_name" class="form-input" value="{{ old('venue_name') }}"
              placeholder="Dewan Seri Mawar" required>
          </div>
          <div class="form-group">
            <label class="form-label">Dress Code</label>
            <input type="text" name="dress_code" class="form-input" value="{{ old('dress_code') }}"
              placeholder="Pastel Green & Soft Pink">
          </div>
        </div>
        <div class="form-grid cols-1">
          <div class="form-group">
            <label class="form-label">Venue Address <span>*</span></label>
            <input type="text" name="venue_address" class="form-input" value="{{ old('venue_address') }}"
              placeholder="No. 12, Jalan Bahagia, Johor Bahru" required>
          </div>
        </div>
        <div class="form-grid cols-1">
          <div class="form-group">
            <label class="form-label">Google Maps URL</label>
            <input type="url" name="maps_url" class="form-input" value="{{ old('maps_url') }}"
              placeholder="https://maps.google.com/...">
            <div class="form-hint">Paste the full Google Maps share link</div>
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
                value="{{ old('story_'.$i.'_year') }}"
                placeholder="{{ ['2019','2020','2022','2025'][$i-1] }}">
            </div>
            <div class="form-group">
              <label class="form-label">Title</label>
              <input type="text" name="story_{{ $i }}_title" class="form-input"
                value="{{ old('story_'.$i.'_title') }}"
                placeholder="{{ ['First Meeting ✨','Growing Together 🌿','The Proposal 💍','Forever Begins 🌸'][$i-1] }}">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="story_{{ $i }}_desc" class="form-textarea" rows="2"
              placeholder="Write your story here...">{{ old('story_'.$i.'_desc') }}</textarea>
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
            <input type="text" name="tng_number" class="form-input" value="{{ old('tng_number') }}"
              placeholder="012-345 6789">
          </div>
          <div class="form-group">
            <label class="form-label">Bank Name</label>
            <input type="text" name="bank_name" class="form-input" value="{{ old('bank_name') }}"
              placeholder="Maybank">
          </div>
        </div>
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Bank Account Number</label>
            <input type="text" name="bank_number" class="form-input" value="{{ old('bank_number') }}"
              placeholder="1234 5678 9012">
          </div>
          <div class="form-group">
            <label class="form-label">Account Holder Name</label>
            <input type="text" name="bank_holder" class="form-input" value="{{ old('bank_holder') }}"
              placeholder="Amir Hafizi bin Ahmad">
          </div>
        </div>
        {{-- QR Code --}}
        <div class="form-section-label" style="margin-top:0.8rem;">DuitNow / QR Code</div>
        <div class="form-group">
          <label class="form-label">QR Code Image</label>
          <div class="upload-box upload-box-sm" onclick="document.getElementById('qr').click()" style="max-width:220px;">
            <div class="upload-preview" id="qrPreview">
              <div class="upload-placeholder">
                <span>📱</span>
                <span>Click to upload QR</span>
                <span style="font-size:0.62rem;opacity:0.5;">DuitNow / QR Pay</span>
              </div>
            </div>
          </div>
          <input type="file" id="qr" name="qr_image" accept="image/*"
            style="display:none" onchange="previewPhoto(this,'qrPreview')">
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
          Max 5MB per photo · JPG, PNG, WEBP accepted
        </p>

        {{-- Photo 1 — full width --}}
        <div class="form-group" style="margin-bottom:1rem;">
          <label class="form-label">Photo 1 — Main Banner (landscape)</label>
          <div class="upload-box" onclick="document.getElementById('p1').click()">
            <div class="upload-preview" id="p1Preview">
              <div class="upload-placeholder">
                <span>🌸</span>
                <span>Click to upload Photo 1</span>
                <span style="font-size:0.62rem;opacity:0.5;">Recommended: 16:9 · landscape</span>
              </div>
            </div>
          </div>
          <input type="file" id="p1" name="photo_1" accept="image/*"
            style="display:none" onchange="previewPhoto(this,'p1Preview')">
          @error('photo_1')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
        </div>

        {{-- Photo 2 & 3 --}}
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Photo 2 (portrait)</label>
            <div class="upload-box upload-box-sm" onclick="document.getElementById('p2').click()">
              <div class="upload-preview" id="p2Preview">
                <div class="upload-placeholder">
                  <span>🌿</span>
                  <span>Click to upload</span>
                </div>
              </div>
            </div>
            <input type="file" id="p2" name="photo_2" accept="image/*"
              style="display:none" onchange="previewPhoto(this,'p2Preview')">
            @error('photo_2')<div style="font-size:0.65rem;color:var(--danger);margin-top:0.3rem;">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label class="form-label">Photo 3 (portrait)</label>
            <div class="upload-box upload-box-sm" onclick="document.getElementById('p3').click()">
              <div class="upload-preview" id="p3Preview">
                <div class="upload-placeholder">
                  <span>💐</span>
                  <span>Click to upload</span>
                </div>
              </div>
            </div>
            <input type="file" id="p3" name="photo_3" accept="image/*"
              style="display:none" onchange="previewPhoto(this,'p3Preview')">
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
        <div class="panel-title">Publish</div>
      </div>
      <div class="panel-body">
        <div class="form-group" style="margin-bottom:1.2rem;">
          <label class="form-label">Status</label>
          <select name="is_active" class="form-select">
            <option value="1" {{ old('is_active','1')=='1' ? 'selected' : '' }}>✅ Active — Visible to guests</option>
            <option value="0" {{ old('is_active')=='0' ? 'selected' : '' }}>⏸ Inactive — Hidden from guests</option>
          </select>
        </div>
        <div class="form-group" style="margin-bottom:1.2rem;">
          <label class="form-label">Background Music URL</label>
          <input type="url" name="music_url" class="form-input" value="{{ old('music_url') }}"
            placeholder="https://...mp3">
          <div class="form-hint">Optional .mp3 link for background music</div>
        </div>
        <div style="display:flex;flex-direction:column;gap:0.6rem;">
          <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Save & Create Card
          </button>
          <a href="{{ route('admin.cards.index') }}" class="btn btn-ghost" style="width:100%;justify-content:center;">
            Cancel
          </a>
        </div>
      </div>
    </div>

    {{-- Card URL Preview --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">Card URL Preview</div>
      </div>
      <div class="panel-body">
        <p style="font-size:0.7rem;color:rgba(255,255,255,0.3);margin-bottom:0.8rem;">Auto-generated from couple names:</p>
        <div style="background:rgba(200,169,110,0.06);border:1px solid var(--accent-border);border-radius:8px;padding:0.8rem;font-size:0.72rem;color:var(--accent);word-break:break-all;">
          {{ url('/card/') }}/<span id="slugPreview" style="opacity:0.6;">groom-bride</span>
        </div>
      </div>
    </div>

    {{-- Tips --}}
    <div class="panel">
      <div class="panel-header">
        <div class="panel-title">💡 Tips</div>
      </div>
      <div style="padding:1.2rem 1.4rem;">
        <div style="font-size:0.72rem;color:rgba(255,255,255,0.3);line-height:2;">
          ✦ <strong style="color:rgba(255,255,255,0.5);">Name on Card</strong> — use short/nickname only<br>
          ✦ <strong style="color:rgba(255,255,255,0.5);">Hijri Date</strong> — auto-fills when you pick a date<br>
          ✦ <strong style="color:rgba(255,255,255,0.5);">Our Story</strong> — leave blank for default text<br>
          ✦ Set <strong style="color:rgba(255,255,255,0.5);">Inactive</strong> while preparing the card<br>
          ✦ Card link <strong style="color:rgba(255,255,255,0.5);">cannot be changed</strong> after creation
        </div>
      </div>
    </div>

  </div>{{-- end right --}}

</div>{{-- end grid --}}
</form>

@endsection

@section('scripts')
<script>
// ── Live slug preview ──
function makeSlug(str){return str.toLowerCase().trim().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'');}
function updateSlug(){
  const g = document.querySelector('[name="groom_name"]').value;
  const b = document.querySelector('[name="bride_name"]').value;
  document.getElementById('slugPreview').textContent = (g||b) ? (makeSlug(g+'-'+b)||'groom-bride') : 'groom-bride';
}
document.querySelector('[name="groom_name"]').addEventListener('input', updateSlug);
document.querySelector('[name="bride_name"]').addEventListener('input', updateSlug);

// ── Auto Hijri Date ──
document.getElementById('weddingDate').addEventListener('change', function() {
  if (!this.value) return;
  try {
    const date = new Date(this.value + 'T12:00:00'); // noon to avoid timezone shift

    // Malay month names in Islamic calendar
    const hijriMonths = [
      'Muharram','Safar','Rabiulawal','Rabiulakhir',
      'Jamadilawal','Jamadilakhir','Rejab','Syaaban',
      'Ramadan','Syawal','Zulkaedah','Zulhijjah'
    ];

    // Use Intl to get hijri parts
    const fmt = new Intl.DateTimeFormat('en-u-ca-islamic', {
      day: 'numeric', month: 'numeric', year: 'numeric'
    });
    const parts = fmt.formatToParts(date);
    const hDay   = parts.find(p => p.type === 'day')?.value;
    const hMonth = parseInt(parts.find(p => p.type === 'month')?.value) - 1;
    const hYear  = parts.find(p => p.type === 'year')?.value;

    const hijriStr = `${hDay} ${hijriMonths[hMonth] ?? ''} ${hYear}H`;
    document.getElementById('hijriDate').value = hijriStr;
  } catch(e) {
    // fallback — leave empty if Intl not supported
    console.warn('Hijri conversion failed:', e);
  }
});

// ── Photo upload preview ──
function previewPhoto(input, previewId) {
  if (!input.files || !input.files[0]) return;

// Validate size (256MB)
  if (input.files[0].size > 256 * 1024 * 1024) {
    showToast('Photo must be under 256MB ⚠️', 'error');
    input.value = '';
    return;
  }

  const reader = new FileReader();
  reader.onload = e => {
    document.getElementById(previewId).innerHTML =
      `<img src="${e.target.result}"
            style="width:100%;height:100%;object-fit:cover;border-radius:10px;display:block;">`;
  };
  reader.readAsDataURL(input.files[0]);
}
</script>
@endsection