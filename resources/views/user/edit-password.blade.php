<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-warning text-dark rounded p-4">
                    <h1 class="h3 mb-2"><i class="bi bi-key"></i> {{ $title }}</h1>
                    <p class="mb-0">Ubah password untuk meningkatkan keamanan akun Anda.</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
                </a>
                <a href="{{ route('user.edit-profile') }}" class="btn btn-primary">
                    <i class="bi bi-person"></i> Edit Profil
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Form Ganti Password -->
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-shield-lock"></i> Form Ganti Password</h5>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h6><i class="bi bi-exclamation-triangle"></i> Terjadi Kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.update-password') }}" method="POST" id="passwordForm">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="password_lama" class="form-label">Password Lama <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_lama')">
                                        <i class="bi bi-eye" id="toggleIcon1"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_baru" class="form-label">Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru" name="password_baru" 
                                           minlength="8" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru')">
                                        <i class="bi bi-eye" id="toggleIcon2"></i>
                                    </button>
                                </div>
                                <small class="text-muted">Password minimal 8 karakter.</small>
                            </div>

                            <div class="mb-3">
                                <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru_confirmation" 
                                           name="password_baru_confirmation" minlength="8" required>
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru_confirmation')">
                                        <i class="bi bi-eye" id="toggleIcon3"></i>
                                    </button>
                                </div>
                                <div id="passwordMatch" class="form-text"></div>
                            </div>

                            <!-- Security Tips -->
                            <div class="alert alert-info">
                                <h6><i class="bi bi-lightbulb"></i> Tips Keamanan Password:</h6>
                                <ul class="mb-0 small">
                                    <li>Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                                    <li>Hindari menggunakan informasi pribadi yang mudah ditebak</li>
                                    <li>Jangan gunakan password yang sama di berbagai platform</li>
                                    <li>Ganti password secara berkala</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary me-md-2">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-warning" id="submitBtn" disabled>
                                    <i class="bi bi-check-circle"></i> Ubah Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                field.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }

        // Validasi real-time password confirmation
        document.getElementById('password_baru_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password_baru').value;
            const confirmation = this.value;
            const matchDiv = document.getElementById('passwordMatch');
            const submitBtn = document.getElementById('submitBtn');

            if (confirmation === '') {
                matchDiv.innerHTML = '';
                submitBtn.disabled = true;
            } else if (password === confirmation) {
                matchDiv.innerHTML = '<small class="text-success"><i class="bi bi-check-circle"></i> Password cocok</small>';
                submitBtn.disabled = false;
            } else {
                matchDiv.innerHTML = '<small class="text-danger"><i class="bi bi-x-circle"></i> Password tidak cocok</small>';
                submitBtn.disabled = true;
            }
        });

        document.getElementById('password_baru').addEventListener('input', function() {
            const confirmation = document.getElementById('password_baru_confirmation');
            if (confirmation.value !== '') {
                confirmation.dispatchEvent(new Event('input'));
            }
        });
    </script>
</x-layout>