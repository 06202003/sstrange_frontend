@extends('layouts.template')

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid px-3 mt-2">
            <div class="jumbotron text-center">
                <h1 class="display-4">SSTRANGE</h1>
                <h2 class="display-6"><b>S</b>calable <b>S</b>imilarity <b>TR</b>acker in <b>A</b>cademia with <b>N</b>atural lan<b>G</b>uage <b>E</b>xplanation</h2>
                <p class="lead">Efficiently track similarities among submissions in various programming languages with SSTRANGE.</p>
            </div>
        </div>
        <div class="container-fluid px-3 mt-2">
            <div class="row d-flex justify-content-center">
                <!-- General Details and Publications Box -->
                <div class="col-md-6">
                    <div class="card shadow-sm p-3">
                        <h2>General Details</h2>
                        <p>SSTRANGE is a scalable and efficient tool to observe similarities among submissions with locality sensitive hashing: MinHash and Super-Bit. Currently, the tool supports Java, Python, C#, Dart, and Web (HTML+JS+CSS+PHP) submissions. It also incorporates sensitive similarity.</p>
                        
                        <h2>Publications</h2>
                        <ul>
                            <li>Details of SSTRANGE can be found in the paper published in MDPI's Education Sciences as part of the special issue "<a href="https://www.mdpi.com/2227-7102/13/1/54" target="_blank">Application of New Technologies for Assessment in Higher Education</a>".</li>
                            <li>Details of C# mode can be seen in the paper published in the "<a href="https://ieeexplore.ieee.org/abstract/document/10260942">2023 IEEE International Conference on Advanced Learning Technologies (ICALT)</a>".</li>
                            <li>Details of sensitive similarity can be seen in the paper published in the "<a href="https://ieeexplore.ieee.org/abstract/document/10500603">2024 IEEE World Engineering Education Conference (EDUNINE)</a>".</li>
                        </ul>
                    </div>
                </div>
        
                <!-- Right Column (Comparison and Get Started) -->
                <div class="col-md-6">
                    <div class="row">
                        <!-- Get Started with SSTRANGE Box -->
                        <div class="col-md-12">
                            <div class="card shadow-sm p-3 text-center">
                                <h2>Get Started with SSTRANGE</h2>
                                <p>Ready to analyze submissions for similarity? Click the button below to start.</p>
                                <a href="{{ route('form') }}" class="btn btn-primary w-100 mb-3">Start SSTRANGE</a>
                            </div>
                        </div>

                        <!-- Comparison with CSTRANGE Box -->
                        <div class="col-md-12 mt-3 ">
                            <div class="card shadow-sm p-3 text-center">
                                <h2>Comparison with CSTRANGE</h2>
                                <p>Unlike its counterpart, Comprehensive STRANGE, SSTRANGE focuses on efficiency and is suitable for large submissions. SSTRANGE offers better speed, while CSTRANGE is more effective in distinguishing program similarity. For comprehensive reporting, it is recommended to use Comprehensive STRANGE or CSTRANGE instead.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    <!-- /.content -->
@endsection

 