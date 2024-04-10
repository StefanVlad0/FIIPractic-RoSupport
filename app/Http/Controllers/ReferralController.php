<?php

namespace App\Http\Controllers;

use Endroid\QrCode\RoundBlockSizeMode;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\ValidationException;


class ReferralController extends Controller
{
    public function show()
    {
        return view('referral');
    }

    public function generateQrCode()
    {
        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create(route('invite', ['name' => Auth::user()->name]))
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::High)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $result = $writer->write($qrCode);

        // Validate the result
        //$writer->validateResult($result, route('invite', ['name' => Auth::user()->name]));

        return response($result->getString(), 200, ['Content-Type' => $result->getMimeType()]);
    }

}
