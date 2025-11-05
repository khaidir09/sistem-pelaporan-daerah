@extends('admin.admin_master')
@section('admin')

<div class="content">

    <!-- Start Content-->
    <div class="container-xxl">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Tambah IKK Outcome</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0">
                     <a href="{{ route('outcome.index') }}" class="btn btn-dark">Kembali</a>
                </ol>
            </div>
        </div>

        <!-- Form Validation -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">

<div class="card-body">
    <form id="myForm" action="{{ route('outcome.store') }}" method="post" class="row g-3">
        @csrf

        <div class="form-group col-md-6">
            <label for="matter_id" class="form-label">Pilih Urusan</label>
            <select name="matter_id" id="matter_id" class="form-select">
                <option value="" selected>-- Pilih Urusan --</option>
                @foreach ($matters as $matter)
                    <option value="{{ $matter->id }}">{{ $matter->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Urutan</label>
            <input type="text" class="form-control" name="urutan"  > 
        </div>

        <div class="form-group col-md-12">
            <label for="validationDefault01" class="form-label">IKK Outcome</label>
            <input type="text" class="form-control" name="ikk_outcome"  > 
        </div>

        <div class="form-group col-md-12">
            <label for="calculation_type" class="form-label">Tipe Kalkulasi</label>
            <select name="calculation_type" id="calculation_type" class="form-select">
                <option value="formula">Formula</option>
                <option value="checklist">Checklist</option>
                <option value="direct_input">Input Langsung</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Definisi Pembilang</label>
            <input type="text" class="form-control" name="definisi_pembilang"  > 
        </div>

        <div class="form-group col-md-6">
            <label for="validationDefault01" class="form-label">Definisi Penyebut</label>
            <input type="text" class="form-control" name="definisi_penyebut"  > 
        </div>

        <div id="checklist-questions" class="form-group col-md-12" style="display: none;">
            <label class="form-label">Pertanyaan Checklist</label>
            <div id="questions-container">
                <!-- Pertanyaan akan ditambahkan di sini -->
            </div>
            <button type="button" class="btn btn-dark mt-2" id="add-question">Tambah Pertanyaan</button>
        </div>

        <div class="col-12 text-end">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->

          
        </div>

        

    </div> <!-- container-fluid -->

</div>


 <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const calculationType = document.getElementById('calculation_type');
        const checklistQuestions = document.getElementById('checklist-questions');
        const questionsContainer = document.getElementById('questions-container');
        const addQuestionBtn = document.getElementById('add-question');
        const formulaInputs = document.querySelectorAll('input[name="definisi_pembilang"], input[name="definisi_penyebut"]');

        calculationType.addEventListener('change', function () {
            const selectedType = this.value;

            // Sembunyikan semua elemen terkait formula dan checklist
            formulaInputs.forEach(input => input.closest('.form-group').style.display = 'none');
            checklistQuestions.style.display = 'none';

            // Tampilkan elemen berdasarkan tipe kalkulasi yang dipilih
            if (selectedType === 'formula') {
                formulaInputs.forEach(input => input.closest('.form-group').style.display = 'block');
            } else if (selectedType === 'checklist') {
                checklistQuestions.style.display = 'block';
            }
        });

        addQuestionBtn.addEventListener('click', function () {
            const questionIndex = questionsContainer.children.length;
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('input-group', 'mb-2');
            newQuestion.innerHTML = `
                <input type="text" class="form-control" name="calculation_meta[questions][${questionIndex}][q]" placeholder="Masukkan pertanyaan">
                <button type="button" class="btn btn-danger remove-question">Hapus</button>
            `;
            questionsContainer.appendChild(newQuestion);
        });

        questionsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-question')) {
                e.target.closest('.input-group').remove();
            }
        });

        // Trigger change event on page load to set initial state
        calculationType.dispatchEvent(new Event('change'));
    });
</script>

@endsection