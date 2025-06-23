@extends('layouts.travella')

@section('title', 'Travella | Edit Listing')
@section('page-title', 'Edit Listing')

@section('content')
@if ($errors->any())
<div class="alert-error">
    <strong>There were some problems with your input:</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('host.listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="title">Listing Title</label>
    <input type="text" id="title" name="title" value="{{ old('title', $listing->title) }}" required />

    <label for="location">Location</label>
    <input type="text" id="location" name="location" value="{{ old('location', $listing->location) }}" required />

    <label for="price">Price per Night</label>
    <input type="number" id="price" name="price" value="{{ old('price', $listing->price) }}" min="0" required />

    <label for="description">Description</label>
    <textarea id="description" name="description" required>{{ old('description', $listing->description) }}</textarea>

    <label>Amenities</label>
<div class="amenities">
    @foreach($allAmenities as $amenity)
    <div class="amenity-item">
        <input type="checkbox" id="amenity_{{ $amenity->id }}" name="amenities[]"
            value="{{ $amenity->id }}"
            {{ in_array($amenity->id, $listing->amenities->pluck('id')->toArray()) ? 'checked' : '' }}>
        <label for="amenity_{{ $amenity->id }}">
            <i class="{{ $amenity->icon }}"></i> {{ $amenity->name }}
        </label>
    </div>
    @endforeach
</div>


    <div class="number-group">
        <div class="number-input-container">
            <label for="bedrooms"><i class="fas fa-bed"></i> Bedrooms</label>
            <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms', $listing->bedrooms) }}" min="1" step="1" required />
        </div>
        <div class="number-input-container">
            <label for="bathrooms"><i class="fas fa-bath"></i> Bathrooms</label>
            <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms', $listing->bathrooms) }}" min="1" step="1" required />
        </div>
    </div>

    <label for="images">Upload Images</label>
    <input type="file" id="images" name="images[]" accept="image/*" multiple />

    <h3>Existing Images</h3>
    <div class="existing-images">
        @foreach($listing->photos as $photo)
        <div class="photo-item" id="photo-{{ $photo->id }}" style="display: inline-block; margin: 10px; position: relative;">
            <img src="{{ asset($photo->path) }}" alt="Listing Image" style="max-width: 150px; max-height: 150px; display: block; border: 1px solid #ccc; border-radius: 5px;" />
            <button type="button" class="delete-photo-btn" data-photo-id="{{ $photo->id }}" style="position: absolute; top: 5px; right: 5px; background: red; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer;">&times;</button>
        </div>
        @endforeach
    </div>

    <button type="submit" class="submit-button">Update Listing</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.delete-photo-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const photoId = this.getAttribute('data-photo-id');
            if (!confirm('Are you sure you want to delete this photo?')) return;

            fetch("{{ url('/host/photos') }}/" + photoId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const photoDiv = document.getElementById('photo-' + photoId);
                    if(photoDiv) photoDiv.remove();
                } else {
                    alert('Failed to delete photo.');
                }
            })
            .catch(() => alert('Failed to delete photo.'));
        });
    });
});
</script>
@endsection
