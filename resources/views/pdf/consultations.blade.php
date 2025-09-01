<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultations - {{ $pet->pet_name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2 { margin: 0; }
        h1 { font-size: 18px; text-align: center; margin-bottom: 5px; }
        h2 { font-size: 14px; margin-top: 10px; margin-bottom: 5px; border-bottom: 1px solid #333; padding-bottom: 3px; }
        p { margin: 0 0 5px 0; }
        .section { margin-bottom: 15px; }
        .grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .grid div { flex: 1 1 45%; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1>Consultation Record</h1>
    <p class="text-center">Dipolog Veterinary Doctor</p>

    <!-- Patient Info -->
    <div class="section">
        <h2>Patient Information</h2>
        <div class="grid">
            <div><strong>Pet Name:</strong> {{ $pet->pet_name }}</div>
            <div><strong>Species:</strong> {{ $pet->pet_species }}</div>
            <div><strong>Breed:</strong> {{ $pet->pet_breed }}</div>
            <div><strong>Sex:</strong> {{ $pet->pet_sex }}</div>
            <div><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($pet->date_of_birth)->format('F d, Y') }}</div>
        </div>
    </div>

    <!-- Owner Info -->
    <div class="section">
        <h2>Owner Information</h2>
        <p><strong>Name:</strong> {{ $pet->owner_name }}</p>
    </div>

    <!-- Consultation History -->
    <div class="section">
        <h2>Previous Consultations</h2>
        @if($consultations->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Vet</th>
                    <th>Body Weight</th>
                    <th>Respiratory Rate</th>
                    <th>Temperature</th>
                    <th>Complaint</th>
                    <th>Medication</th>
                    <th>Prescription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $c)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($c->created_at)->format('F j, Y g:i A') }}</td>
                        <td>{{ $c->vet_name }}</td>
                        <td>{{ $c->body_weight ?? 'N/A' }}</td>
                        <td>{{ $c->respiratory_rate ?? 'N/A' }}</td>
                        <td>{{ $c->temperature ?? 'N/A' }}</td>
                        <td>{{ $c->complaint ?? 'N/A' }}</td>
                        <td>{{ $c->medication ?? 'N/A' }}</td>
                        <td>{{ $c->prescription ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No consultations found.</p>
        @endif
    </div>
</body>
</html>
