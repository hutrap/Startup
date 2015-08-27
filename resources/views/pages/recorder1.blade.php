@extends('app')
@section('title') Recorder :: @parent @stop
@section('content')
    <script src="../js/Recorderjs/recaudio.js"></script> <!-- load recorder -->

    <p>Click Start for recording, once done, click Stop to stop and grab the WAV file.</p>
    <p id="record_content"></p>
    <button>Record</button>
    <button  disabled>Stop</button>


@endsection
