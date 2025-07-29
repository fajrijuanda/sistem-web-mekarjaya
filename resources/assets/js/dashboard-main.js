/**
 * Main Dashboard
 */

'use strict';
(function () {
  let cardColor, headingColor, labelColor, shadeColor, borderColor, axisColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    borderColor = config.colors_dark.borderColor;
    axisColor = config.colors_dark.axisColor;
    shadeColor = 'dark';
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    borderColor = config.colors.borderColor;
    axisColor = config.colors.axisColor;
    shadeColor = '';
  }

  // Swiper Card
  // --------------------------------------------------------------------
  const swiperWithPagination = document.querySelector('#swiper-with-pagination-cards');
  if (swiperWithPagination) {
    new Swiper(swiperWithPagination, {
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      pagination: {
        clickable: true,
        el: '.swiper-pagination'
      }
    });
  }

  // Grafik Tren Aktivitas Desa (Line Chart)
  // --------------------------------------------------------------------
  const activityChartEl = document.querySelector('#activityChart');
  if (typeof activityChartEl !== 'undefined' && activityChartEl !== null) {
    const activityChartConfig = {
      chart: { height: 255, type: 'area', parentHeightOffset: 0, toolbar: { show: false } },
      dataLabels: { enabled: false },
      stroke: { width: 3, curve: 'smooth' },
      series: [
        { name: 'Layanan', data: trenData.layanan },
        { name: 'Artikel', data: trenData.artikel }
      ],
      colors: [config.colors.primary, config.colors.info],
      fill: {
        type: 'gradient',
        gradient: { shade: shadeColor, shadeIntensity: 0.8, opacityFrom: 0.5, opacityTo: 0.1, stops: [0, 85, 100] }
      },
      grid: {
        show: true,
        borderColor: labelColor,
        strokeDashArray: 3,
        padding: { top: -15, bottom: -10, left: 15, right: 10 }
      },
      xaxis: {
        categories: trenData.labels,
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: labelColor, fontSize: '13px' } }
      },
      yaxis: { labels: { style: { colors: labelColor, fontSize: '13px' } } },
      tooltip: { shared: true }
    };
    const activityChart = new ApexCharts(activityChartEl, activityChartConfig);
    activityChart.render();
  }

  // Komposisi Kategori Layanan (Donut Chart) - DIPERBAIKI
  // --------------------------------------------------------------------
  const serviceCompositionChartEl = document.querySelector('#serviceCompositionChart');
  if (typeof serviceCompositionChartEl !== 'undefined' && serviceCompositionChartEl !== null) {
    const labels = komposisiLayananData.map(item => item.nama_kategori);
    const series = komposisiLayananData.map(item => item.permohonan_layanans_count); // Menggunakan key yang benar

    const serviceCompositionChartOptions = {
      chart: {
        height: 250,
        type: 'donut'
      },
      labels: labels,
      series: series,
      colors: [
        config.colors.primary,
        config.colors.success,
        config.colors.warning,
        config.colors.info,
        config.colors.danger,
        config.colors.secondary
      ],
      stroke: {
        width: 5,
        colors: [cardColor]
      },
      dataLabels: {
        enabled: false
      },
      legend: {
        show: false // Legenda sudah dibuat manual di HTML
      },
      grid: {
        padding: {
          top: 15,
          bottom: -10,
          left: 0,
          right: 0
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val);
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '0.8125rem',
                color: axisColor,
                label: 'Total',
                formatter: function (w) {
                  return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                }
              }
            }
          }
        }
      }
    };
    const serviceCompositionChart = new ApexCharts(serviceCompositionChartEl, serviceCompositionChartOptions);
    serviceCompositionChart.render();
  }

  // Grafik Sumber Pengunjung (Donut Chart)
  // --------------------------------------------------------------------
  const trafficSourceChartEl = document.querySelector('#trafficSourceChart');
  if (typeof trafficSourceChartEl !== 'undefined' && trafficSourceChartEl !== null) {
    const trafficSourceChartConfig = {
      chart: { height: 170, width: 150, parentHeightOffset: 0, type: 'donut' },
      labels: ['Google', 'Facebook', 'Direct', 'Lainnya'],
      series: [45, 25, 20, 10], // Data dummy
      colors: [config.colors.primary, config.colors.info, config.colors.success, config.colors.secondary],
      stroke: { width: 0 },
      dataLabels: { enabled: false },
      legend: { show: false },
      tooltip: { theme: false },
      grid: { padding: { top: 0 } },
      plotOptions: {
        pie: {
          donut: {
            size: '70%',
            labels: {
              show: true,
              value: {
                fontSize: '1.125rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                fontWeight: 500,
                offsetY: -20,
                formatter: val => parseInt(val) + '%'
              },
              name: { offsetY: 20, fontFamily: 'Public Sans' },
              total: { show: true, fontSize: '.9375rem', label: 'Total', color: labelColor, formatter: w => '15.2k' } // Data dummy
            }
          }
        }
      }
    };
    const trafficSourceChart = new ApexCharts(trafficSourceChartEl, trafficSourceChartConfig);
    trafficSourceChart.render();
  }

  // Grafik Kategori Paling Populer (Horizontal Bar)
  // --------------------------------------------------------------------
  const popularCategoriesChartEl = document.querySelector('#popularCategoriesChart');
  if (typeof popularCategoriesChartEl !== 'undefined' && popularCategoriesChartEl !== null) {
    const popularCategoriesChartConfig = {
      chart: { height: 320, type: 'bar', toolbar: { show: false } },
      plotOptions: {
        bar: { horizontal: true, barHeight: '70%', distributed: true, startingShape: 'rounded', borderRadius: 7 }
      },
      grid: {
        strokeDashArray: 10,
        borderColor: borderColor,
        xaxis: { lines: { show: true } },
        yaxis: { lines: { show: false } },
        padding: { top: -35, bottom: -12 }
      },
      colors: [
        config.colors.primary,
        config.colors.info,
        config.colors.success,
        config.colors.secondary,
        config.colors.danger
      ],
      dataLabels: {
        enabled: true,
        style: { colors: ['#fff'], fontWeight: 500, fontSize: '13px', fontFamily: 'Public Sans' },
        formatter: (val, opts) => popularCategoriesChartConfig.labels[opts.dataPointIndex],
        offsetX: 0,
        dropShadow: { enabled: false }
      },
      labels: ['Berita Desa', 'Pengumuman', 'UMKM', 'Kesehatan', 'Kegiatan'], // Data dummy
      series: [{ data: [42, 35, 22, 18, 11] }], // Data dummy
      xaxis: {
        categories: ['42%', '35%', '22%', '18%', '11%'],
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: labelColor, fontSize: '13px' }, formatter: val => `${val}` }
      },
      yaxis: { max: 45, labels: { style: { colors: [labelColor], fontFamily: 'Public Sans', fontSize: '13px' } } },
      tooltip: {
        enabled: true,
        style: { fontSize: '12px' },
        onDatasetHover: { highlightDataSeries: false },
        custom: ({ series, seriesIndex, dataPointIndex, w }) =>
          '<div class="px-3 py-2"><span>' + series[seriesIndex][dataPointIndex] + ' Dilihat</span></div>'
      },
      legend: { show: false }
    };
    const popularCategoriesChart = new ApexCharts(popularCategoriesChartEl, popularCategoriesChartConfig);
    popularCategoriesChart.render();
  }

  // Tabel Permohonan Layanan Terbaru (DataTable)
  // --------------------------------------------------------------------
  var dt_requests_table = $('.datatables-requests');
  if (dt_requests_table.length) {
    dt_requests_table.DataTable({
      ajax: {
        url: '/dashboard/latest-requests',
        error: function (xhr, error, code) {
          console.log('DataTables AJAX Error:', xhr.responseJSON || xhr.responseText);
        }
      },
      columns: [
        { data: '' },
        { data: 'id' },
        { data: 'service_name' },
        { data: 'applicant_name' },
        { data: 'date' },
        { data: 'status' },
        { data: '' }
      ],
      columnDefs: [
        {
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: () => ''
        },
        {
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 3,
          checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' },
          render: () => '<input type="checkbox" class="dt-checkboxes form-check-input">'
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: (data, type, full) =>
            `<h6 class="text-truncate mb-0">${full.service_name}</h6><small>${full.service_type}</small>`
        },
        { targets: 3, render: (data, type, full) => `<span class="text-heading">${full.applicant_name}</span>` },
        { targets: 4, render: (data, type, full) => `<span class="text-heading">${full.date}</span>` },
        {
          targets: -2,
          render: function (data, type, full, meta) {
            const status = {
              Selesai: { title: 'Selesai', class: 'bg-label-success' },
              Diproses: { title: 'Diproses', class: 'bg-label-warning' },
              Ditolak: { title: 'Ditolak', class: 'bg-label-danger' },
              Diajukan: { title: 'Diajukan', class: 'bg-label-info' }
            };
            return `<span class="badge ${status[full.status].class}">${status[full.status].title}</span>`;
          }
        },
        {
          targets: -1,
          searchable: false,
          title: 'Aksi',
          orderable: false,
          render: (data, type, full) =>
            `<div class="d-inline-block"><a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;" class="dropdown-item">Detail</a><a href="javascript:;" class="dropdown-item">Arsipkan</a></div></div>`
        }
      ],
      order: [[4, 'desc']],
      dom: '<"card-header pb-0 pt-sm-0"<"head-label text-center"><"d-flex justify-content-center justify-content-md-end"f>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 5,
      lengthMenu: [5, 10, 25, 50],
      language: { search: '', searchPlaceholder: 'Cari Layanan...', sProcessing: 'Memuat...' },
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: row => 'Detail dari "' + row.data().service_name + '"'
          }),
          type: 'column',
          renderer: (api, rowIdx, columns) => {
            var data = $.map(columns, (col, i) =>
              col.title !== ''
                ? `<tr data-dt-row="${col.rowIndex}" data-dt-column="${col.columnIndex}"><td>${col.title}:</td> <td>${col.data}</td></tr>`
                : ''
            ).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Permohonan Layanan Terbaru</h5>');
  }

  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
})();
