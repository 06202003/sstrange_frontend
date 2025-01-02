@extends('layouts.template')

@section('content')
    <div class="container-fluid py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5 text-center mb-4 mb-md-0">
                <img src="{{ asset('images/about.jpg') }}" alt="Logo" class="img-fluid w-75 rounded-3">

                <div class=" mt-2 text-center">
                    <div>
                        <h1 class="fs-3">Let's Stay Connected</h1>
                    </div>
                    <div class="contact-details">
                        <p><strong>Email:</strong> <a href="mailto:oscar.karnalim@it.maranatha.edu">oscar.karnalim@it.maranatha.edu</a></p>
                        <p><strong>Office:</strong> Maranatha Christian University, Bandung</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <h1 class="mb-4">About SSTRANGE</h1>
                <p class="lead"><strong>SSTRANGE</strong> is a web-based platform dedicated to enhancing academic integrity by providing efficient and user-friendly tools for detecting programming plagiarism. Our non-commercial system prioritizes privacy, accessibility, and innovation, offering advanced similarity measurements to support educators in fostering honest and high-quality learning environments.</p>

                <!-- Buttons for Show/Hide Sections (Flex) -->
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary flex-fill" id="btn-general">General Details</button>
                    <button class="btn btn-primary flex-fill" id="btn-publications">Publications</button>
                    <button class="btn btn-primary flex-fill" id="btn-comparison">CSTRANGE Comparison</button>
                </div>

                <!-- Content sections with animation -->
                <div class="mt-4">
                    <!-- General Details Section -->
                    <div id="general-details" class="content-section" style="display: none; opacity: 0; transition: opacity 0.5s ease-in-out;">
                        <h2>General Details</h2>
                        <p>SSTRANGE is a scalable and efficient tool for detecting similarities in submissions using locality-sensitive hashing techniques such as MinHash and Super-Bit. It currently supports submissions in Java, Python, C#, Dart, and Web technologies (HTML, JS, CSS, PHP), with sensitivity to code similarity nuances.</p>
                    </div>

                    <!-- Publications Section -->
                    <div id="publications" class="content-section" style="display: none; opacity: 0; transition: opacity 0.5s ease-in-out;">
                        <h2>Publications</h2>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="bi bi-journal-bookmark-fill"></i> 
                                Find more details about SSTRANGE in the paper published in MDPI's Education Sciences as part of the special issue 
                                "<a href="https://www.mdpi.com/2227-7102/13/1/54" target="_blank">Application of New Technologies for Assessment in Higher Education</a>".
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-journal-bookmark-fill"></i> 
                                The C# mode is discussed in the paper published at the "<a href="https://ieeexplore.ieee.org/abstract/document/10260942" target="_blank">2023 IEEE International Conference on Advanced Learning Technologies (ICALT)</a>".
                            </li>
                            <li class="mb-3">
                                <i class="bi bi-journal-bookmark-fill"></i> 
                                Sensitive similarity is covered in the paper presented at the "<a href="https://ieeexplore.ieee.org/abstract/document/10500603" target="_blank">2024 IEEE World Engineering Education Conference (EDUNINE)</a>".
                            </li>
                        </ul>
                    </div>

                    <!-- Comparison Section -->
                    <div id="comparison" class="content-section" style="display: none; opacity: 0; transition: opacity 0.5s ease-in-out;">
                        <h2>Comparison with CSTRANGE</h2>
                        <p>SSTRANGE is optimized for large-scale submissions with a focus on speed, making it more efficient than its counterpart, Comprehensive STRANGE (CSTRANGE), which provides more detailed similarity distinctions. For a deeper analysis, CSTRANGE may be recommended.</p>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
@endsection

@section('custom-javascript')
<script>
    // Wait until the document is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Get buttons and content sections
        const btnGeneral = document.getElementById('btn-general');
        const btnPublications = document.getElementById('btn-publications');
        const btnComparison = document.getElementById('btn-comparison');

        const generalSection = document.getElementById('general-details');
        const publicationsSection = document.getElementById('publications');
        const comparisonSection = document.getElementById('comparison');

        let currentSection = null; // Keep track of the currently visible section

        // Function to hide all sections with opacity animation
        function hideAllSections() {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.style.opacity = '0';
                section.style.display = 'none'; // Hide after opacity transition
            });
        }

        // Function to toggle section visibility
        function toggleSection(section) {
            if (currentSection === section) {
                // If the clicked section is already visible, hide it
                section.style.opacity = '0';
                setTimeout(() => {
                    section.style.display = 'none';
                }, 500); // Match the opacity transition duration
                currentSection = null; // Reset current section
            } else {
                // If the clicked section is different, hide others and show the clicked one
                hideAllSections();
                section.style.display = 'block'; // Show section first
                setTimeout(() => {
                    section.style.opacity = '1'; // Trigger opacity transition
                }, 10); // Small delay to trigger opacity transition
                currentSection = section; // Update the current visible section
            }
        }

        // Button click events
        btnGeneral.addEventListener('click', function() {
            toggleSection(generalSection);
        });

        btnPublications.addEventListener('click', function() {
            toggleSection(publicationsSection);
        });

        btnComparison.addEventListener('click', function() {
            toggleSection(comparisonSection);
        });
    });
</script>
@endsection

