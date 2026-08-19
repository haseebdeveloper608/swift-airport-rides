<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Driver Application</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #0A142E; background-color: #f4f6fa; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        
        <!-- Header -->
        <div style="background: #0A142E; color: #ffffff; padding: 24px; text-align: center; border-bottom: 4px solid #FFD426;">
            <h2 style="margin: 0; font-size: 22px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">New Driver Application</h2>
            <p style="margin: 6px 0 0; color: #FFD426; font-size: 14px;">Swift Ride Taxis — Chauffeur & Driver Network</p>
        </div>

        <!-- Content -->
        <div style="padding: 28px;">
            <p style="font-size: 15px; margin-bottom: 20px;">A new driver application has been submitted on <strong>Swift Ride Taxis</strong>. Below are the complete applicant details:</p>

            <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 14px;">
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568; width: 40%;">Full Name:</td>
                    <td style="padding: 10px 0; color: #1a202c; font-weight: 600;">{{ $application->full_name }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Email Address:</td>
                    <td style="padding: 10px 0; color: #2E6BE6; font-weight: 600;">
                        <a href="mailto:{{ $application->email }}" style="color: #2E6BE6; text-decoration: none;">{{ $application->email }}</a>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Mobile Phone:</td>
                    <td style="padding: 10px 0; color: #1a202c; font-weight: 600;">
                        <a href="tel:{{ $application->phone }}" style="color: #1a202c; text-decoration: none;">{{ $application->phone }}</a>
                    </td>
                </tr>
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Date of Birth:</td>
                    <td style="padding: 10px 0; color: #1a202c;">{{ $application->date_of_birth ?? 'Not provided' }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Driven Before for Us:</td>
                    <td style="padding: 10px 0; color: #1a202c; font-weight: 600;">{{ $application->previous_driver }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Vehicle Option:</td>
                    <td style="padding: 10px 0; color: #1a202c; font-weight: 600;">{{ $application->vehicle_option }}</td>
                </tr>
                @if($application->pco_license)
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">PCO License No:</td>
                    <td style="padding: 10px 0; color: #1a202c;">{{ $application->pco_license }}</td>
                </tr>
                @endif
                @if($application->vehicle_details)
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Vehicle Model/Year:</td>
                    <td style="padding: 10px 0; color: #1a202c;">{{ $application->vehicle_details }}</td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 10px 0; font-weight: 700; color: #4a5568;">Submission Date:</td>
                    <td style="padding: 10px 0; color: #718096;">{{ $application->created_at->format('d M Y, h:i A') }}</td>
                </tr>
            </table>

            <div style="margin-top: 24px; padding: 16px; background: #EBF1FF; border-radius: 8px; text-align: center;">
                <p style="margin: 0; font-size: 13px; color: #2E6BE6; font-weight: 600;">This application is saved in your admin database.</p>
            </div>
        </div>

        <!-- Footer -->
        <div style="background: #f8fafc; padding: 16px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 12px; color: #718096;">
            &copy; {{ date('Y') }} Swift Ride Taxis. All rights reserved.
        </div>
    </div>
</body>
</html>
