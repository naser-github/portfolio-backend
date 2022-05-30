<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    public function index()
    {
        $applications = Application::orderBy('application_priority', 'desc')->orderBy('id', 'desc')->paginate(12);

        $response = [
            'application' => $applications,
        ];

        return response($response, 200);
    }

//    public function partialIndex($id)
//    {
//        $applications = Application::where('application_status', $id)->orderBy('application_priority', 'asc')->get();
//
//        $response = [
//            'application' => $applications,
//        ];
//
//        return response($response, 200);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'website' => 'required',
            'status' => 'required'
//            'images' => '',
//            'images.*' => 'image|mimes:jpeg,png,jpg|max:1000',
//            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:1000',
        ], [
//            'images.*.required' => 'Please Upload an image',
//            'images.mimes' => 'must be a jpeg,png,jpg file',
//            'images.max' => 'image size exceeded',
        ]);

        // return $request->file('thumbnail');

        $title = $request->input('title');
        $website = $request->input('website');
        $summary = $request->input('summary');
        $app_body = $request->input('app_body');
        $app_status = $request->input('status');
        $thumbnail = $request->file('thumbnail');

        $application = new Application();

        $application->application_name = $title;
        $application->application_website = $website;
        $application->application_summary = $summary;
        $application->application_body = $app_body;

        if ($request->hasFile('thumbnail')) {
            $destinationPath = public_path('image');

            $ext = $thumbnail->getClientOriginalExtension();

            $file_name = uniqid() . "." . $ext;

            $thumbnail->move($destinationPath, $file_name);

            $application->application_thumbnail = $file_name;
        }

        $application->application_status = $app_status;

        $application->save();

        $response = [
            'msg' => 'application has been added',
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::where('id', $id)->first();

        if ($application) {
            $response = [
                'application' => $application,
            ];

            return response($response, 200);
        } else {
            $response = [
                'msg' => 'application not found',
            ];

            return response($response, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'website' => 'required',
            'status' => 'required'
        ]);

        $title = $request->input('title');
        $website = $request->input('website');
        $summary = $request->input('summary');
        $app_body = $request->input('app_body');
        $app_status = $request->input('status');
        $thumbnail = $request->file('thumbnail');

        $application = Application::where('id', $id)->first();

        if ($application) {
            $application->application_name = $title;
            $application->application_website = $website;
            $application->application_summary = $summary;
            $application->application_body = $app_body;

            if ($request->hasFile('thumbnail') and $thumbnail != $application->application_thumbnail) {
                $destinationPath = public_path('image');

                $ext = $thumbnail->getClientOriginalExtension();

                $file_name = uniqid() . "." . $ext;

                $thumbnail->move($destinationPath, $file_name);

                $application->application_thumbnail = $file_name;
            }

            $application->application_status = $app_status;

            $application->save();

            $response = [
                'msg' => 'application has been updated',
            ];

            return response($response, 201);
        } else {
            $response = [
                'msg' => 'application not found',
            ];

            return response($response, 404);
        }
    }

//    public function count()
//    {
//        $live = Application::where('application_status', 'live')->count();
//        $ongoing = Application::where('application_status', 'ongoing')->count();
//
//        $response = [
//            'live' => $live,
//            'ongoing' => $ongoing
//        ];
//
//        return response($response, 200);
//    }
}
