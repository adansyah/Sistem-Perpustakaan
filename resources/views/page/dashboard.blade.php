@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Dashboard Header -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <div class="mb-4 md:mb-0">
                <h1 class="text-3xl font-bold text-gray-100">Welcome</h1>
                <p class="text-gray-400 mt-1">Selamat Datang {{ Auth::user()->name ?? 'User' }} di Perpustakaan SMPN 2
                    Lumbung</p>
            </div>

        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-xl border border-gray-700/50 overflow-hidden relative group">
                <div
                    class="absolute inset-0 bg-cyan-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center py-6">
                        <div>
                            <h2 class="text-gray-400 font-medium mb-1">Buku</h2>
                            <p class="text-4xl font-bold text-white mb-3">{{ $buku }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-cyan-600/10 border border-cyan-600/20">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-10 w-10 text-cyan-400"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>

                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-xl border border-gray-700/50 overflow-hidden relative group">
                <div
                    class="absolute inset-0 bg-emerald-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start py-6">
                        <div>
                            <h2 class="text-gray-400 font-medium mb-1">Pinjaman</h2>
                            <p class="text-4xl font-bold text-white mb-3">{{ $loan }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-emerald-600/10 border border-emerald-600/20">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-10 w-10 text-red-400"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-xl border border-gray-700/50 overflow-hidden relative group">
                <div
                    class="absolute inset-0 bg-amber-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                </div>
                <div class="py-12 px-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-gray-400 font-medium mb-1">Anggota</h2>
                            <p class="text-4xl font-bold text-white mb-3">{{ $member }}</p>
                            <div class="flex items-center text-sm">

                            </div>
                        </div>
                        <div class="p-3 rounded-lg bg-amber-600/10 border border-amber-600/20">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-10 w-10 text-amber-400"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar and Time in Indonesia -->
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-xl border border-gray-700/50 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-200 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd" />
                </svg>
                Indonesia Kalender & Waktu
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Calendar -->
                <div class="bg-gray-900/70 rounded-xl border border-gray-700/50 p-5 shadow-inner">
                    <div class="text-center">
                        <p id="calendar-title" class="font-bold mb-4 text-gray-200"></p>
                        <div class="grid grid-cols-7 gap-1 text-xs" id="calendar-days">
                            <!-- Calendar will be generated by JS -->
                        </div>
                    </div>
                </div>

                <!-- Current Time in Indonesia -->
                <div
                    class="bg-gray-900/70 rounded-xl border border-gray-700/50 p-5 shadow-inner flex items-center justify-center">
                    <div class="text-center">
                        <p class="text-sm font-medium text-gray-400 mb-3">Waktu Saat ini di Indonesia</p>
                        <div class="relative">
                            <div class="absolute inset-0 bg-cyan-600/10 blur-xl rounded-full"></div>
                            <p id="IndonesiaTime" class="text-4xl font-bold text-white relative"></p>
                        </div>
                        <p id="IndonesiaDate" class="text-sm text-gray-400 mt-3"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateIndonesiaTime() {
                const now = new Date();
                const options = {
                    timeZone: 'Asia/Jakarta'
                };

                const timeString = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    ...options
                });

                const dateString = now.toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    ...options
                });

                document.getElementById('IndonesiaTime').textContent = timeString + " WIB";
                document.getElementById('IndonesiaDate').textContent = dateString;
            }

            function generateCalendar() {
                const now = new Date();
                const options = {
                    timeZone: 'Asia/Jakarta'
                };
                const today = new Date(now.toLocaleString("en-US", {
                    timeZone: "Asia/Jakarta"
                }));

                const year = today.getFullYear();
                const month = today.getMonth(); // 0 = Jan
                const firstDay = new Date(year, month, 1).getDay(); // index hari pertama
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Set judul kalender
                const monthName = today.toLocaleString('id-ID', {
                    month: 'long'
                });
                document.getElementById('calendar-title').textContent = `${monthName} ${year}`;

                // Render nama hari
                const daysContainer = document.getElementById('calendar-days');
                daysContainer.innerHTML = `
                <div class="font-medium text-gray-400 p-2">Min</div>
                <div class="font-medium text-gray-400 p-2">Sen</div>
                <div class="font-medium text-gray-400 p-2">Sel</div>
                <div class="font-medium text-gray-400 p-2">Rab</div>
                <div class="font-medium text-gray-400 p-2">Kam</div>
                <div class="font-medium text-gray-400 p-2">Jum</div>
                <div class="font-medium text-gray-400 p-2">Sab</div>
            `;

                // Kosong di awal bulan
                for (let i = 0; i < firstDay; i++) {
                    daysContainer.innerHTML += `<div class="p-2"></div>`;
                }

                // Isi tanggal
                for (let d = 1; d <= daysInMonth; d++) {
                    const isToday = d === today.getDate();
                    daysContainer.innerHTML += `
                    <div class="p-2 text-gray-300 ${isToday ? 'bg-cyan-600/20 rounded-full text-cyan-300 font-medium' : ''}">
                        ${d}
                    </div>
                `;
                }
            }

            updateIndonesiaTime();
            setInterval(updateIndonesiaTime, 1000);

            generateCalendar();
        });
    </script>

    <style>
        /* Glow effects */
        #IndonesiaTime {
            text-shadow: 0 0 15px rgba(6, 182, 212, 0.5);
        }

        .bg-cyan-600\/10 {
            box-shadow: 0 0 10px rgba(8, 145, 178, 0.1);
        }

        .bg-emerald-600\/10 {
            box-shadow: 0 0 10px rgba(5, 150, 105, 0.1);
        }

        .bg-amber-600\/10 {
            box-shadow: 0 0 10px rgba(217, 119, 6, 0.1);
        }

        .bg-rose-600\/10 {
            box-shadow: 0 0 10px rgba(225, 29, 72, 0.1);
        }

        /* Smooth transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        /* Table styles */
        table {
            border-collapse: separate;
            border-spacing: 0;
        }

        /* Calendar day hover effect */
        .grid-cols-7>div:not(:empty):not(.bg-cyan-600\/20):hover {
            background-color: rgba(8, 145, 178, 0.1);
            border-radius: 9999px;
            cursor: pointer;
        }
    </style>
@endsection
