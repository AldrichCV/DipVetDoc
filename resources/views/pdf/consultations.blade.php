<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultation Record - {{ $pet->pet_name }}</title>
    <style>
        /* Enhanced print-optimized styling for professional medical document */
        @page {
            size: A4;
            margin: 20mm 15mm;
        }
        
        body { 
            font-family: 'Times New Roman', serif; 
            font-size: 11px; 
            line-height: 1.4;
            color: #000;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .clinic-name {
            font-size: 24px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
            letter-spacing: 1px;
        }
        
        .clinic-subtitle {
            font-size: 14px;
            color: #64748b;
            margin: 5px 0 0 0;
            font-style: italic;
        }
        
        .document-title {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0 5px 0;
            color: #1e40af;
        }
        
        .print-date {
            font-size: 10px;
            color: #64748b;
            margin-top: 10px;
        }
        
        h2 { 
            font-size: 14px; 
            margin: 20px 0 10px 0; 
            color: #1e40af;
            border-bottom: 2px solid #e2e8f0; 
            padding-bottom: 5px;
            font-weight: bold;
        }
        
        .section { 
            margin-bottom: 20px; 
            page-break-inside: avoid;
        }
        
        .info-grid { 
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .info-item {
            display: flex;
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            min-width: 120px;
            color: #374151;
        }
        
        .info-value {
            color: #000;
        }
        
        .owner-section {
            background-color: #f8fafc;
            padding: 15px;
            border-left: 4px solid #2563eb;
            margin: 15px 0;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 15px;
            font-size: 10px;
        }
        
        th, td { 
            border: 1px solid #d1d5db; 
            padding: 8px 6px; 
            text-align: left;
            vertical-align: top;
        }
        
        th { 
            background-color: #f3f4f6;
            font-weight: bold;
            color: #374151;
            font-size: 10px;
        }
        
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        
        .no-consultations {
            text-align: center;
            padding: 30px;
            color: #6b7280;
            font-style: italic;
            background-color: #f9fafb;
            border: 2px dashed #d1d5db;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            font-size: 10px;
            color: #6b7280;
        }
        
        .signature-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 50px;
        }
        
        .signature-box {
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 5px;
            margin-top: 40px;
        }
        
        /* Print-specific optimizations */
        @media print {
            body { -webkit-print-color-adjust: exact; }
            .section { page-break-inside: avoid; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <!-- Enhanced professional header -->
    <div class="header">
        <h1 class="clinic-name">DIPOLOG VETERINARY CLINIC</h1>
        <p class="clinic-subtitle">Professional Veterinary Care & Medical Services</p>
        <h2 class="document-title">CONSULTATION RECORD</h2>
        <p class="print-date">Generated on: {{ now()->format('F d, Y \a\t g:i A') }}</p>
    </div>

    <!-- Improved patient information layout -->
    <div class="section">
        <h2>Patient Information</h2>
        <div class="info-grid">
            <div>
                <div class="info-item">
                    <span class="info-label">Pet Name:</span>
                    <span class="info-value">{{ $pet->pet_name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Species:</span>
                    <span class="info-value">{{ $pet->pet_species }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Breed:</span>
                    <span class="info-value">{{ $pet->pet_breed }}</span>
                </div>
            </div>
            <div>
                <div class="info-item">
                    <span class="info-label">Sex:</span>
                    <span class="info-value">{{ $pet->pet_sex }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pet->date_of_birth)->format('F d, Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Age:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($pet->date_of_birth)->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced owner information section -->
    <div class="section">
        <h2>Owner Information</h2>
        <div class="owner-section">
            <div class="info-item">
                <span class="info-label">Owner Name:</span>
                <span class="info-value">{{ $pet->owner_name }}</span>
            </div>
        </div>
    </div>

    <!-- Improved consultation history table -->
    <div class="section">
        <h2>Consultation History</h2>
        @if($consultations->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">Date & Time</th>
                    <th style="width: 12%;">Veterinarian</th>
                    <th style="width: 8%;">Weight (kg)</th>
                    <th style="width: 8%;">Resp. Rate</th>
                    <th style="width: 8%;">Temp. (°C)</th>
                    <th style="width: 20%;">Chief Complaint</th>
                    <th style="width: 16%;">Medication</th>
                    <th style="width: 16%;">Prescription</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultations as $c)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($c->created_at)->format('M j, Y\ng:i A') }}</td>
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
        <div class="no-consultations">
            <p><strong>No consultation records found for this patient.</strong></p>
            <p>This appears to be a new patient or no consultations have been recorded yet.</p>
        </div>
        @endif
    </div>

    <!-- Added professional footer with signatures -->
    <div class="footer">
        <div class="signature-section">
            <div>
                <div class="signature-box">
                    <strong>Attending Veterinarian</strong>
                </div>
            </div>
            <div>
                <div class="signature-box">
                    <strong>Pet Owner Signature</strong>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <p><em>This document was generated electronically and serves as an official medical record.</em></p>
            <p>Dipolog Veterinary Clinic • Professional Veterinary Care</p>
        </div>
    </div>
</body>
</html>
