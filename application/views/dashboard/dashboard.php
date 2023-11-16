<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->
	<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap"> Grafik</h5>
                  <p>5 Alternatif Rangking Tertinggi</p>
                </div>
                <div class="col-md-6">
                  <div id="wpTotalRevenueChart" class="px-2"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
							<div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
								<div class="card-title">
									<h5 class="text-wrap text-center" style="line-height: 2;">SISTEM PENDUKUNG KEPUTUSAN PENGANGKATAN KARYAWAN TETAP MENGGUNAKAN METODE ANALYTICAL HIERARCHY PROCESS  (AHP) PADA PT. ALBANY CORONA LESTARI</h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ Expense Overview -->
      <div class="row mt-4">
        <div class="col-md-6 col-xl-4">
          <div class="card bg-info text-white mb-3">
            <div class="card-body text-white">
              <h5 class="card-title text-white">Nilai Preferensi</h5>
              <ol>
                <?php foreach ($datapreferensi as $key => $dpf): ?>
                    <li><?= $dpf .'('.$key.')';  ?></li>
                <?php endforeach ?>
              </ol>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-4">
          <div class="card bg-primary text-white mb-3">
            <div class="card-body">
              <h5 class="card-title text-white">Kriteria</h5>
              <ol>
                <?php foreach ($datakriteria as $key => $dk): ?>
                    <li><?= $dk->kriteria;  ?></li>
                <?php endforeach ?>
              </ol>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xl-4">
          <div class="card bg-secondary text-white mb-3">
            <div class="card-header">Jumlah Alternatif</div>
            <div class="card-body">
              <h1 class="card-title text-white"><?= $dataalternatif; ?></h1>
            </div>
          </div>
        </div>
      </div>
	</div>
</div>
<!-- / Content -->

<script src="<?= base_url(); ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script type="text/javascript">
let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;

  // Total Revenue Report Chart - Bar Chart
  // --------------------------------------------------------------------
  const totalRevenueChartEl = document.querySelector('#wpTotalRevenueChart'),
    totalRevenueChartOptions = {
      series: [
        {
          name: 'Nilai',
          data: [80,90,76,79]
        }
      ],
      chart: {
        height: 300,
        width: 650,
        stacked: true,
        type: 'bar',
        toolbar: { show: false }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '33%',
          borderRadius: 12,
          startingShape: 'rounded',
          endingShape: 'rounded'
        }
      },
      colors: [config.colors.primary, config.colors.info],
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 6,
        lineCap: 'round',
        colors: [cardColor]
      },
      legend: {
        show: true,
        horizontalAlign: 'left',
        position: 'top',
        markers: {
          height: 8,
          width: 8,
          radius: 12,
          offsetX: -3
        },
        labels: {
          colors: axisColor
        },
        itemMargin: {
          horizontal: 10
        }
      },
      grid: {
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: -8,
          left: 20,
          right: 20
        }
      },
      xaxis: {
        categories: ['satu','dua','tiga','empat'],
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            colors: axisColor
          }
        }
      },
      responsive: [
        {
          breakpoint: 1700,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 1580,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 1440,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '42%'
              }
            }
          }
        },
        {
          breakpoint: 1300,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 1200,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '40%'
              }
            }
          }
        },
        {
          breakpoint: 1040,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 11,
                columnWidth: '48%'
              }
            }
          }
        },
        {
          breakpoint: 991,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '30%'
              }
            }
          }
        },
        {
          breakpoint: 840,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '35%'
              }
            }
          }
        },
        {
          breakpoint: 768,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '28%'
              }
            }
          }
        },
        {
          breakpoint: 640,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '32%'
              }
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '37%'
              }
            }
          }
        },
        {
          breakpoint: 480,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '45%'
              }
            }
          }
        },
        {
          breakpoint: 420,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '52%'
              }
            }
          }
        },
        {
          breakpoint: 380,
          options: {
            plotOptions: {
              bar: {
                borderRadius: 10,
                columnWidth: '60%'
              }
            }
          }
        }
      ],
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      }
    };
  if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
    const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
    totalRevenueChart.render();
  }


</script>