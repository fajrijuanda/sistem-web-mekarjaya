/**
 * Main Dashboard
 */

'use strict';

(function () {
  let cardColor, headingColor, labelColor, shadeColor;
  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    labelColor = config.colors_dark.textMuted;
    headingColor = config.colors_dark.headingColor;
    shadeColor = 'dark';
  } else {
    cardColor = config.colors.cardColor;
    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
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

  // Grafik Tren Aktivitas Desa
  // --------------------------------------------------------------------
  const activityChartEl = document.querySelector('#activityChart'),
    activityChartConfig = {
      chart: {
        height: 255,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: { show: false }
      },
      dataLabels: { enabled: false },
      stroke: {
        width: 3,
        curve: 'smooth'
      },
      series: [
        {
          name: 'Layanan',
          data: [80, 100, 90, 110, 70, 120]
        },
        {
          name: 'Artikel',
          data: [20, 35, 25, 45, 22, 40]
        }
      ],
      colors: [config.colors.primary, config.colors.info],
      fill: {
        type: 'gradient',
        gradient: {
          shade: shadeColor,
          shadeIntensity: 0.8,
          opacityFrom: 0.5,
          opacityTo: 0.1,
          stops: [0, 85, 100]
        }
      },
      grid: {
        show: true,
        borderColor: labelColor,
        strokeDashArray: 3,
        padding: { top: -15, bottom: -10, left: 15, right: 10 }
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: { style: { colors: labelColor, fontSize: '13px' } }
      },
      yaxis: {
        labels: {
          style: { colors: labelColor, fontSize: '13px' }
        }
      },
      tooltip: {
        shared: true
      }
    };
  if (typeof activityChartEl !== undefined && activityChartEl !== null) {
    const activityChart = new ApexCharts(activityChartEl, activityChartConfig);
    activityChart.render();
  }

  // Komposisi Kategori Layanan
  // --------------------------------------------------------------------
  const serviceCompositionChartEl = document.querySelector('#serviceCompositionChart'),
    serviceCompositionChartOptions = {
      series: [75, 30, 15], // Data: Kependudukan, Usaha, Sosial
      labels: ['Kependudukan', 'Usaha', 'Sosial'],
      chart: {
        height: 360,
        type: 'donut'
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '2rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) + ' ';
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: true,
                fontSize: '.7rem',
                label: 'Total',
                color: labelColor,
                formatter: function (w) {
                  return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                }
              }
            }
          }
        }
      },
      colors: [config.colors.primary, config.colors.info, config.colors.warning],
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 15,
          bottom: -10
        }
      }
    };
  if (typeof serviceCompositionChartEl !== undefined && serviceCompositionChartEl !== null) {
    const serviceCompositionChart = new ApexCharts(serviceCompositionChartEl, serviceCompositionChartOptions);
    serviceCompositionChart.render();
  }

  // Tabel Permohonan Layanan Terbaru
  // --------------------------------------------------------------------
  var dt_requests_table = $('.datatables-requests');
  if (dt_requests_table.length) {
    dt_requests_table.DataTable({
      ajax: assetsPath + 'json/layanan-terbaru.json',
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
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          orderable: false,
          searchable: false,
          responsivePriority: 3,
          checkboxes: {
            selectAllRender: '<input type="checkbox" class="form-check-input">'
          },
          render: function () {
            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
          }
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return (
              '<h6 class="text-truncate mb-0">' +
              full.service_name +
              '</h6>' +
              '<small>' +
              full.service_type +
              '</small>'
            );
          }
        },
        {
          targets: 3,
          render: function (data, type, full, meta) {
            return '<span class="text-heading">' + full.applicant_name + '</span>';
          }
        },
        {
          targets: 4,
          render: function (data, type, full, meta) {
            return '<span class="text-heading">' + full.date + '</span>';
          }
        },
        {
          targets: -2,
          render: function (data, type, full, meta) {
            var $status_number = full['status'];
            var $status = {
              1: { title: 'Selesai', class: 'bg-label-success' },
              2: { title: 'Diproses', class: 'bg-label-warning' },
              3: { title: 'Ditolak', class: 'bg-label-danger' }
            };
            if (typeof $status[$status_number] === 'undefined') {
              return data;
            }
            return (
              '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
            );
          }
        },
        {
          targets: -1,
          searchable: false,
          title: 'Aksi',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block">' +
              '<a href="javascript:;" class="btn btn-icon btn-text-secondary waves-effect waves-light rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-md"></i></a>' +
              '<div class="dropdown-menu dropdown-menu-end m-0">' +
              '<a href="javascript:;" class="dropdown-item">Detail</a>' +
              '<a href="javascript:;" class="dropdown-item">Arsipkan</a>' +
              '</div>' +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom: '<"card-header pb-0 pt-sm-0"<"head-label text-center"><"d-flex justify-content-center justify-content-md-end"f>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 5,
      lengthMenu: [5, 10, 25, 50, 75, 100],
      language: {
        search: '',
        searchPlaceholder: 'Cari Layanan...'
      },
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Detail dari "' + data['service_name'] + '"';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== ''
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');
            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Permohonan Layanan Terbaru</h5>');
  }

  // Filter form control to default size
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
})();
