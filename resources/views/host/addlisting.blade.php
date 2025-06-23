<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Travella | Add New Listing</title>
  <link rel="stylesheet" href="{{ asset('css/addlisting.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

</head>

<body>
    <nav>
        <div class="nav-left" tabindex="0" role="banner" aria-label="Brand logo">Travella</div>
    <div class="nav-center" role="navigation" aria-label="Primary navigation">
      <span class="nav-title">Host Dashboard</span>
    </div>
    <div class="nav-right">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="nav-button" type="submit">Log Out</button>
      </form>
    </div>
    </nav>

    <main>
        
        <div class="back-button-wrapper">
        <a href="{{ route('host.dashboard') }}" class="btn btn-back">← Back to Dashboard</a>
        </div>
        
        <div class="container">
            
            <h1>Add New Listing</h1>
            <form method="POST" action="{{ route('host.listings.store') }}" enctype="multipart/form-data">
    @csrf
                <label for="title">Listing Title</label>
                <input type="text" id="title" name="title" placeholder="Enter listing title" required />

                <label for="location">Location</label>
                <input type="text" id="location" name="location" placeholder="Enter location" required />

                <label for="price">Price per Night</label>
                <input type="number" id="price" name="price" placeholder="Enter price per night" min="0" required />

                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Enter description" required></textarea>

                <label>Amenities</label>
                <div class="amenities">
                    <div class="amenity-item"><input type="checkbox" id="parking" name="amenities[]"
                            value="3" /><label for="bedroom"><i class="fas fa-car"></i> Parking</label></div>
                    <div class="amenity-item"><input type="checkbox" id="elevator" name="amenities[]"
                            value="4" /><label for="bathroom"><i class="fas fa-elevator"></i> Elevator Access </label></div>
                    <div class="amenity-item"><input type="checkbox" id="wifi" name="amenities[]"
                            value="8" /><label for="wifi"><i class="fas fa-wifi"></i> Free Wi-Fi</label></div>
                    <div class="amenity-item"><input type="checkbox" id="ac" name="amenities[]"
                            value="9" /><label for="ac"><i class="fas fa-wind"></i> Air Conditioning</label></div>
                    <div class="amenity-item"><input type="checkbox" id="kitchen" name="amenities[]"
                            value="10" /><label for="kitchen"><i class="fas fa-utensils"></i> Fully Equipped Kitchen</label></div>
                    <div class="amenity-item"><input type="checkbox" id="washer" name="amenities[]"
                            value="6" /><label for="washer"><i class="fas fa-soap"></i> Washer & Dryer</label></div>
                    <div class="amenity-item"><input type="checkbox" id="pool" name="amenities[]"
                            value="1" /><label for="pool"><i class="fas fa-water"></i> Swimming Pool</label></div>
                    <div class="amenity-item"><input type="checkbox" id="gym" name="amenities[]"
                            value="2" /><label for="gym"><i class="fas fa-dumbbell"></i> Gym</label></div>
                    <div class="amenity-item"><input type="checkbox" id="balcony" name="amenities[]"
                            value="5" /><label for="balcony"><i class="fas fa-mountain-sun"></i> Private Balcony</label></div>
                    <div class="amenity-item"><input type="checkbox" id="tv" name="amenities[]"
                            value="7" /><label for="tv"><i class="fas fa-tv"></i> Smart TV</label></div>
                </div>

                <div class="number-group">
                    <div class="number-input-container">
                        <label for="bedrooms"><i class="fas fa-bed"></i> Bedrooms</label>
                        <input type="number" id="bedrooms" name="bedrooms" placeholder="Number of bedrooms" min="1"
                            step="1" required aria-required="true" />
                    </div>
                    <div class="number-input-container">
                        <label for="bathrooms"><i class="fas fa-bath"></i> Bathrooms</label>
                        <input type="number" id="bathrooms" name="bathrooms" placeholder="Number of bathrooms" min="1"
                            step="1" required aria-required="true" />
                    </div>
                </div>

                <label for="images">Upload Images (Max 10 MB per image)</label>
                <input type="file" id="images" name="images[]" accept="image/*" multiple />


                <button type="submit" class="submit-button">Add Listing</button>
            </form>
        </div>
    </main>

    <footer>
        &copy; 2025 Travella. All rights reserved.
    </footer>
</body>

</html>