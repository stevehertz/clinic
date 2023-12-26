<?php

namespace App\Http\Controllers\Users\Payments;

use App\Models\PaymentBill;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Users\Payments\StorePaymentsAttachmentRequest;
use App\Http\Requests\Users\Payments\UpdatePaymentsAttachmentRequest;

class PaymentsAttachmentController extends Controller
{

    use FileUploadTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentsAttachmentRequest $request, PaymentBill $paymentBill)
    {
        //
        $data = $request->except("_token");

        $paymentAttachment = new PaymentAttachment();

        $paymentAttachment->user_id = Auth::user()->id;
        $paymentAttachment->bill_id = $paymentBill->id;
        $paymentAttachment->title = $data["title"];
        $paymentAttachment->slug = Str::slug($data['title']);
        if ($request->hasFile('file')) {
            $storagePath = 'public/attachments';
            $fileName = 'file';
            $paymentAttachment->file = $this->uploadFile($request, $fileName, $storagePath);
        }

        $paymentAttachment->save();

        $response = [
            'status' => true,
            'message' => 'File successfully attached'
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentAttachment $paymentAttachment)
    {
        //
        $response = [
            'status' => true,
            'data' => $paymentAttachment
        ];

        return response()->json($response);
    }

    /**
     * Open the specified stored resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function openFile(PaymentAttachment $paymentAttachment)
    {
        // Define the storage path for your files
        $storagePath = storage_path('app/public/attachments');

        // Full path to the file
        $filePath = $storagePath . '/' . $paymentAttachment->file;

        // Check if the file exists
        if (file_exists($filePath)) {

            // Get the file extension
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

            // Set the appropriate Content-Type header
            $contentType = $fileExtension === 'pdf' ? 'application/pdf' : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
         
            // Send the file as a response with headers
            return Response::make(file_get_contents($filePath), 200, [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'inline; filename="' . $paymentAttachment->file . '"',
            ]);
        }

        return $filePath;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaymentsAttachmentRequest $request, PaymentAttachment $paymentAttachment)
    {
        //
        $data = $request->except("_token");

        $paymentAttachment->user_id = Auth::user()->id;
        $paymentAttachment->bill_id = $paymentAttachment->bill_id;
        $paymentAttachment->title = $data['title'];
        $paymentAttachment->slug = Str::slug($data['title']);
        if ($request->hasFile('file')) {
            $storagePath = 'public/attachments';
            $fileName = 'file';
            $paymentAttachment->file = $this->uploadFile($request, $fileName, $storagePath);
        }

        $paymentAttachment->save();

        $response = [
            'status' => true,
            'message' => 'File successfully updated'
        ];

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentAttachment $paymentAttachment)
    {
        //
        $path = 'public/attachments';
        $file = $paymentAttachment->file;
        $this->delete_file($path, $file);
        $paymentAttachment->delete();
        $response = [
            'status' => true,
            'message' => 'File successfully removed'
        ];

        return response()->json($response);
    }
}
