export const dollaChart = {
    type: 'bar',
    /*data: {
      labels: ['Costa', 'ASOS', 'Spotify'],
      datasets: [
        { 
          label: 'Hours expected',
          data: [5, 13, 15 ],
          backgroundColor: [
            'transparent'
          ],
          borderColor:'#A7A7FF',
          borderWidth: 3
        },
        {
          label: 'Hours worked',
          data: [6, 10, 11 ],
          backgroundColor: [
            'transparent'
          ],
          borderColor: '#47b784',
          borderWidth: 3
        }
      ] */
    //},
    options: {
      responsive: true,
      legend: {
          labels: {
            fontColor: '#EEE5E9'
          }
      },
      lineTension: 1,
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            padding: 25,
            fontColor: '#EEE5E9'
          }
        }],
        xAxes: [{
            ticks: {
                fontColor: '#EEE5E9'
            }
        }]
      }
    }
  }
  
  export default dollaChart;