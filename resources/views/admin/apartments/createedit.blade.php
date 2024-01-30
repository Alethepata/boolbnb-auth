@extends('layouts.admin')

@section('content')
    <h1>{{ $title }}</h1>

    {{-- Versione Desktop  --}}
    <div class="container-d">

        <form enctype="multipart/form-data" action="{{ $route }}" method="POST" id="form">

            @csrf
            @method($method)
            <div class="mb-3">
                <label for="title" class="form-label brown @error('title') is-invalid @enderror">Nome dell'appartamento
                    *</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ old('title', $apartment?->title) }}">
                <p id="error-title"></p>
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="d-flex">
                <div class="mb-3">
                    <label for="rooms" class="form-label brown @error('rooms') is-invalid @enderror">Numero stanze
                        *</label>
                    <input type="number" class="form-control" id="rooms" name="rooms"
                        value="{{ old('rooms', $apartment?->rooms) }}">
                    <p id="error-rooms"></p>
                    @error('rooms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 mx-4">
                    <label for="beds" class="form-label brown @error('beds') is-invalid @enderror">Numero letti
                        *</label>
                    <input type="number" class="form-control" id="beds" name="beds"
                        value="{{ old('beds', $apartment?->beds) }}">
                    <p id="error-beds"></p>
                    @error('beds')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bathrooms" class="form-label brown @error('bathrooms') is-invalid @enderror">Numero bagni
                        *</label>
                    <input type="number" class="form-control" id="bathrooms" name="bathrooms"
                        value="{{ old('bathrooms', $apartment?->bathrooms) }}">
                    <p id="error-bathrooms"></p>
                    @error('bathrooms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 ms-4">
                    <label for="square-meters" class="form-label brown @error('square_meters') is-invalid @enderror">Metri
                        quadrati
                        *</label>
                    <input type="number" class="form-control" id="square-meters" name="square_meters"
                        value="{{ old('square_meters', $apartment?->square_meters) }}">
                    <p id="error-square-meters"></p>
                    @error('square_meters')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- Indirizzo --}}
            <div class="">
                <label for="address" class="form-label brown @error('address') is-invalid @enderror">Indirizzo *</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ old('address', $apartment?->address) }}" onkeyup="getApi()" autocomplete="off"
                    list="countrydata">
                <p id="error-address"></p>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- tendina indirizzo --}}
            <div class="mb-3">
                <ul id="autocompleteList" class="list-group brown"></ul>
            </div>
            {{-- lat --}}
            <div class="mb-3 d-none">
                <label for="latitude" class="form-label">Latitudine</label>
                <input type="text" class="form-control" id="latitude" name="latitude"
                    value="{{ old('latitude', $apartment?->latitude) }}">
            </div>
            {{-- lon --}}
            <div class="mb-3 d-none">
                <label for="longitude" class="form-label">Longitudine</label>
                <input type="text" class="form-control" id="longitude" name="longitude"
                    value="{{ old('longitude', $apartment?->longitude) }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label brown">Immagine *</label>
                <input type="file" class="form-control" id="image" name="img"
                    value="{{ old('img', $apartment?->img) }}" onchange="imagePreview(event)">
                <p id="error-image"></p>
                <div class="image-container mt-3">
                    <p>Antemprima immagine:</p>
                    <img id="image-preview" width="300" height="200"
                        onerror="this.src='/images/assets/Placeholder.png'"
                        src="{{ asset('storage/' . $apartment?->img) }}" alt="">
                </div>
                @if (session('error'))
                    <p class="text-danger">{{ session('error') }}</p>
                @endif
            </div>

            <div class="visible mb-3">
                <p class="@error('is_visible') is-invalid @enderror">Visibilità *</p>

                <div class="d-flex selected">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="radio" name="is_visible" value="1"
                            id="flexRadioDefault1" @if (old('is_visible', $apartment?->is_visible)) checked @endif>
                        <label class="form-check-label brown" for="flexRadioDefault1">
                            Visibile
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_visible" value="0"
                            id="flexRadioDefault2" @if (!old('is_visible', $apartment?->is_visible)) checked @endif>
                        <label class="form-check-label brown" for="flexRadioDefault2">
                            Non visibile
                        </label>
                    </div>
                    <p id="error-radio"></p>
                </div>
                @error('is_visible')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="services mb-3">
                <p class="@error('services') is-invalid @enderror">Servizi *</p>
                <div class="btn-group flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($services as $service)
                        <input type="checkbox" class="btn-check checkbox" id="service-{{ $service->id }}"
                            name="services[]" value="{{ $service->id }}" autocomplete="off"
                            @if ($apartment?->services->contains($service)) checked @endif>
                        <label class="btn rounded-5 btn-outline-info btn-services"
                            for="service-{{ $service->id }}">{{ $service->title }}</label>
                    @endforeach
                    <p id="error-checkbox"></p>
                </div>
                @error('services')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


        </form>
        <button type="submit" class="btn-submit btn btn-primary" id="btn">Salva</button>
    </div>
    {{-- Fine Versione Desktop  --}}

    <script>
        const apiKey = '5SpDBwX41WJf17bsPmyNJnysKu2nuS3l';
        const apiUrl = 'https://api.tomtom.com/search/2/geocode/';

        function getApi() {
            const search = address.value.trim();

            if (search.length < 5) return;

            axios.get(`${apiUrl}${encodeURIComponent(search)}.json?key=${apiKey}`)
                .then(response => {
                    if (response.data.results.length > 0) {
                        const niceResults = response.data.results.map((result) => ({
                            address: {
                                freeformAddress: result.address.freeformAddress,
                            },
                            position: result.position
                        }));
                        updateAutocompleteList(niceResults);
                    }
                })
                .catch(error => {
                    console.error('Errore nella chiamata API di TomTom:', error);
                });

        }

        function updateAutocompleteList(results) {
            // Cancella l'elenco precedente
            autocompleteList.innerHTML = '';

            // Aggiungi i nuovi suggerimenti all'elenco
            results.forEach(result => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');

                //active al passaggio del mouse
                listItem.addEventListener("mouseover", function() {
                    this.classList.add("active");
                });
                listItem.addEventListener("mouseout", function() {
                    this.classList.remove("active");
                });
                //

                listItem.textContent = result.address.freeformAddress;
                // Aggiungi un gestore di eventi per gestire la selezione di un suggerimento
                listItem.addEventListener('click', function() {
                    address.value = result.address.freeformAddress;
                    latitude.value = result.position.lat;
                    longitude.value = result.position.lon;

                    autocompleteList.innerHTML =
                        '';
                });

                autocompleteList.appendChild(listItem);
            });
        }

        function imagePreview(event) {
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }

        const form = document.getElementById('form');
        const btn = document.getElementById('btn');

        let title = document.getElementById('title');
        let rooms = document.getElementById('rooms');
        let beds = document.getElementById('beds');
        let bathrooms = document.getElementById('bathrooms');
        let squareMeters = document.getElementById('square-meters');
        let address = document.getElementById('address');
        let img = document.getElementById('image');
        let flexRadioDefault1 = document.getElementById('flexRadioDefault1');
        let flexRadioDefault2 = document.getElementById('flexRadioDefault2');
        // let checkbox = document.getElementsByClassName('checkbox');

        let errorTitle = document.getElementById('error-title');
        let errorRooms = document.getElementById('error-rooms');
        let errorBeds = document.getElementById('error-beds');
        let errorBathrooms = document.getElementById('error-bathrooms');
        let errorSquareMeters = document.getElementById('error-square-meters');
        let errorAddress = document.getElementById('error-address');
        let errorImage = document.getElementById('error-image');
        let errorRadio = document.getElementById('error-radio');
        // let errorCheckbox = document.getElementById('error-checkbox');


        btn.addEventListener('click', function() {

            if (title.value.length === 0) {
                message = 'compilare campo';
                errorTitle.className = 'text-danger';
                title.className = 'form-control border-danger';
                errorTitle.innerHTML = message;
            } else {
                message = '';
                title.className = 'form-control border-secondary-subtle';
                errorTitle.innerHTML = message;
            }
            if (rooms.value.length === 0) {
                message = 'compilare campo';
                errorRooms.className = 'text-danger';
                rooms.className = 'form-control border-danger';
                errorRooms.innerHTML = message;
            } else {
                message = '';
                rooms.className = 'form-control border-secondary-subtle';
                errorRooms.innerHTML = message;
            }
            if (beds.value.length === 0) {
                message = 'compilare campo';
                errorBeds.className = 'text-danger';
                beds.className = 'form-control border-danger';
                errorBeds.innerHTML = message;
            } else {
                message = '';
                beds.className = 'form-control border-secondary-subtle';
                errorBeds.innerHTML = message;
            }
            if (bathrooms.value.length === 0) {
                message = 'compilare campo';
                errorBathrooms.className = 'text-danger';
                bathrooms.className = 'form-control border-danger';
                errorBathrooms.innerHTML = message;
            } else {
                message = '';
                bathrooms.className = 'form-control border-secondary-subtle';
                errorBathrooms.innerHTML = message;
            }
            if (squareMeters.value.length === 0) {
                message = 'compilare campo';
                errorSquareMeters.className = 'text-danger';
                squareMeters.className = 'form-control border-danger';
                errorSquareMeters.innerHTML = message;
            } else {
                message = '';
                squareMeters.className = 'form-control border-secondary-subtle';
                errorSquareMeters.innerHTML = message;
            }
            if (address.value.length === 0) {
                message = 'compilare campo';
                errorAddress.className = 'text-danger';
                address.className = 'form-control border-danger';
                errorAddress.innerHTML = message;
            } else {
                message = '';
                address.className = 'form-control border-secondary-subtle';
                errorAddress.innerHTML = message;
            }
            if (img.value.length === 0) {
                message = 'compilare campo';
                errorImage.className = 'text-danger';
                img.className = 'form-control border-danger';
                errorImage.innerHTML = message;
            } else {
                message = '';
                img.className = 'form-control border-secondary-subtle';
                errorImage.innerHTML = message;
            }
            if (flexRadioDefault1.value.length === 0 || flexRadioDefault2.value.length === 0) {
                message = 'compilare campo';
                errorRadio.className = 'text-danger';
                errorRadio.innerHTML = message;
            } else {
                message = '';
                errorRadio.innerHTML = message;
            }
            // if (checkbox.length === 0 ){
            //     message= 'compilare campo';
            //     errorCheckbox.className = 'text-danger';

            //     errorCheckbox.innerHTML = message;
            // }else{
            //     message= '';

            //     errorCheckbox.innerHTML = message;
            // }

            if (title.value.length > 0 &&
                rooms.value.length > 0 &&
                bathrooms.value.length > 0 &&
                squareMeters.value.length > 0 &&
                (flexRadioDefault1.value.length > 0 || flexRadioDefault2.value.length > 0)) {
                form.submit()
            }
        });

        title.addEventListener("blur", function() {

            if (title.value.length < 3) {
                message = 'Il titolo deve avere minimo 3 lettere';
                errorTitle.className = 'text-danger';
                title.className = 'form-control border-danger';
                errorTitle.innerHTML = message;
            } else {
                message = '';
                title.className = 'form-control border-secondary-subtle';
                errorTitle.innerHTML = message;
            }
            if (title.value.length > 255) {
                message = 'Il titolo deve avere massimo 255 lettere';
                errorTitle.className = 'text-danger';
                title.className = 'form-control border-danger';
                errorTitle.innerHTML = message;
            }


        });

        rooms.addEventListener("blur", function() {

            if (rooms.value < 1) {
                message = 'E\' richiesta almeno una camera';
                errorRooms.className = 'text-danger';
                rooms.className = 'form-control border-danger';
                errorRooms.innerHTML = message;
            } else {
                message = '';
                rooms.className = 'form-control border-secondary-subtle';
                errorRooms.innerHTML = message;
            }
            if (rooms.value > 100) {
                message = 'Le camere massime sono 100';
                errorRooms.className = 'text-danger';
                rooms.className = 'form-control border-danger';
                errorRooms.innerHTML = message;
            }


        });

        beds.addEventListener("blur", function() {

            if (beds.value < 1) {
                message = 'E\' richiesto almeno un letto';
                errorBeds.className = 'text-danger';
                beds.className = 'form-control border-danger';
                errorBeds.innerHTML = message;
            } else {
                message = '';
                beds.className = 'form-control border-secondary-subtle';
                errorBeds.innerHTML = message;
            }
            if (beds.value > 100) {
                message = 'Sono richiesti massimo 100 letti';
                errorBeds.className = 'text-danger';
                beds.className = 'form-control border-danger';
                errorBeds.innerHTML = message;
            }


        });
        bathrooms.addEventListener("blur", function() {

            if (bathrooms.value < 1) {
                message = 'E\' richiesto almeno un bagno';
                errorBathrooms.className = 'text-danger';
                bathrooms.className = 'form-control border-danger';
                errorBathrooms.innerHTML = message;
            } else {
                message = '';
                bathrooms.className = 'form-control border-secondary-subtle';
                errorBathrooms.innerHTML = message;
            }
            if (bathrooms.value > 100) {
                message = 'Sono richiesti massimo 100 bagni';
                errorBathrooms.className = 'text-danger';
                bathrooms.className = 'form-control border-danger';
                errorBathrooms.innerHTML = message;
            }

        });
        squareMeters.addEventListener("blur", function() {

            if (squareMeters.value < 10) {
                message = 'Sono richiesti almeno 10 metri quadrati';
                errorSquareMeters.className = 'text-danger';
                squareMeters.className = 'form-control border-danger';
                errorSquareMeters.innerHTML = message;
            } else {
                message = '';
                squareMeters.className = 'form-control border-secondary-subtle';
                errorSquareMeters.innerHTML = message;
            }
            if (squareMeters.value > 1000) {
                message = 'Sono richiesti massimo 1000 metri quadrati';
                errorSquareMeters.className = 'text-danger';
                squareMeters.className = 'form-control border-danger';
                errorSquareMeters.innerHTML = message;
            }

        });
    </script>
@endsection
