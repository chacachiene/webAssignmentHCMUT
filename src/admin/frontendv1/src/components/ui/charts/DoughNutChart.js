import React from "react";
import { Doughnut } from "react-chartjs-2";

const DoughnutChart = ({ dataInput, size}) => {
  const data = {
    datasets: [
      {
        labels: "This will be hide",
        data: dataInput,
        backgroundColor: ["rgb(254, 161, 22)", "rgb(255, 192, 22)", "rgb(178, 134, 15)","rgb(240, 255, 22)"  ],
      },
    ],
    labels: [],
  };

  return (
    <div
      style={{
        width: `${size}px`,
        height: `${size}px`,
      }}
    >
      <Doughnut data={data} />
    </div>
  );
};

export default DoughnutChart;
