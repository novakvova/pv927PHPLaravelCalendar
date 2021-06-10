<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }

    public function index(Request $request)
    {

       /* $events = Event::latest()->where('name', $request.term)->paginate(3);*/

        $events= Event::where([
            ['name', '!=', Null],
            [function ($query) use ($request){
                if(($term=$request->term)){
                    $query->orWhere('name', 'LIKE', '%'.$term.'%')
                        ->orWhere('description', 'LIKE', '%'.$term.'%')->get();
                }
            }]
        ])
            ->orderBy('id', 'desc')
            ->paginate(2);

        return view('events.index',
            compact('events'))->with('i', (request()->input('page', 1) - 1) * 5)
            ->with('term', $request->term);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create', ['image' => 'https://app.hhhtm.com/resources/assets/img/upload_img.jpg',
            'imgSize' => 0, 'ext' => '']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
        ]);

        //dd($request);

        $imageName = time() . '.' . $request->fileExt;
        $targatFile = 'images/'.$imageName;
        $this->base64_to_jpeg($request->imageUpload, $targatFile);

        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName
        ]);
        //Event::create($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
        ]);
        $event->update($request->all());

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully');
    }


}
