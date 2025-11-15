@extends('adminlte::page')

@section('title', 'Validar con Cámara')

@section('meta_tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content_header')
    <h1>Validar Entrada con Cámara</h1>
@stop

@section('content')

    <h1>Escanear QR</h1>

    <div id="reader" style="width: 300px; margin: auto; border: 1px solid #ccc;"></div>

    <div id="result-box" style="
        display:none;
        margin-top:20px;
        padding:20px;
        border-radius:10px;
        border:2px solid #28a745;
        background:#eaffea;
    ">
        <h3>Entrada Validada</h3>
        <p><strong>Comprador:</strong> <span id="res-nombre"></span></p>
        <p><strong>Lote:</strong> <span id="res-lote"></span></p>
        <p><strong>Evento:</strong> <span id="res-evento"></span></p>
    </div>


@endsection


@section('js')
  <script src="https://unpkg.com/html5-qrcode"></script>

<script>
     console.log("STEP 1: El script se está ejecutando.");

    // Verificar si la librería está disponible
    if (typeof Html5Qrcode === "undefined") {
        console.log("STEP 2: ❌ Html5Qrcode NO está definido. (unpkg no cargó)");
    } else {
        console.log("STEP 2: ✅ Html5Qrcode está cargado correctamente desde unpkg.");
    }

    // PASO 3: intentar obtener cámaras
    console.log("STEP 3: Intentando obtener cámaras...");

     Html5Qrcode.getCameras()
    .then(devices => {
        console.log("STEP 4: Lista de cámaras detectadas:", devices);

        if (!devices || devices.length === 0) {
            console.log("STEP 4.1: ❌ No hay cámaras disponibles.");
            return;
        }

        console.log("STEP 4.2: ✅ Cámara encontrada:", devices[0]);

        // PASO 4.3 — Preparar lector QR
        const cameraId = devices[0].id;
        const html5Qr = new Html5Qrcode("reader");

        console.log("STEP 5: Intentando iniciar la cámara...");

        html5Qr.start(
            cameraId,
            { fps: 10, qrbox: 200 }, 
            async (decodedText) => {
                console.log("STEP 6: QR DETECTADO:", decodedText);

                // -------------- STEP 7 ----------------
                console.log("STEP 7: Deteniendo cámara...");

                try {
                    await html5Qr.stop();
                    console.log("STEP 7.1: 📌 Cámara detenida correctamente.");
                } catch (err) {
                    console.log("STEP 7 ERROR al detener cámara:", err);
                }

                console.log("STEP 7.2: Procesando UUID:", decodedText);

                // STEP 8: Validar formato UUID
                const uuidRegex = /^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/;

                if (!uuidRegex.test(decodedText)) {
                    console.log("STEP 8.1 ❌ QR inválido o no es UUID:", decodedText);
                    return; // no seguimos porque no es válido
                }

                console.log("STEP 8.2 ✅ UUID válido:", decodedText);

                // STEP 9: Enviar UUID al backend con fetch()
        console.log("STEP 9: Preparando POST al backend...");

        // Necesitamos el token CSRF de Laravel
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // URL de validación por cámara
        const url = "{{ route('validation.camera.validate', $evento) }}";

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf
            },
            body: JSON.stringify({
                qr_text: decodedText
            })
            })
            .then(response => response.json())
            .then(data => {
                console.log("STEP 9.1: Respuesta del backend:", data);

                if (data.success) {
                    console.log("STEP 9.2: ✅ Entrada válida:", data);

                      console.log("STEP 9.2: ✅ Entrada válida:", data);

                document.getElementById("res-nombre").innerText =
                    data?.entrada?.lote?.evento?.usuario?.name ?? "Desconocido";

                document.getElementById("res-lote").innerText =
                    data?.entrada?.lote?.nombre ?? "Sin lote";

                document.getElementById("res-evento").innerText =
                    data?.entrada?.lote?.evento?.titulo ?? "Evento no encontrado";

                document.getElementById("result-box").style.display = "block";
                } else {
                    console.log("STEP 9.3 ❌ Entrada inválida:", data);
                }
            })
            .catch(error => {
                console.log("STEP 9 ERROR:", error);
            });

                }
            )
            .then(() => {
                console.log("STEP 5.1: ✅ Cámara iniciada correctamente.");
            })
            .catch(err => {
                console.log("STEP 5 ERROR: No se pudo iniciar la cámara:", err);
            });

        })
        .catch(err => {
            console.log("STEP 4 ERROR:", err);
        });

</script>
@stop