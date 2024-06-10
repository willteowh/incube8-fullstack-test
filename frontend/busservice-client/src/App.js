import "tailwindcss/tailwind.css";
import "./App.css";
import API from "./api";
import dayjs from "dayjs";
import { useState } from "react";
import { Button } from "./components/ui/";
import { BusStopList, BusStopDetail } from "./components/";

function App() {
  const [busStops, setBusStops] = useState([]);
  const [errorMessage, setErrorMessage] = useState("");
  const [selectedBusStop, setSelectedBusStop] = useState(null);
  const [busStopDetails, setBusStopDetails] = useState(null);
  const [loadingDetails, setLoadingDetails] = useState(false);

  // dummy User Location (lat and lon)
  const [lat, lon] = [1.35, 103.1];

  const fetchNearestBusStops = async () => {
    try {
      const response = await API.get("/bus-stops", {
        params: { lat, lon },
      });
      setBusStops(response.data.slice(0, 3)); // Get closest 3 bus stops
      setErrorMessage(''); // Clear error message
    } catch (error) {
      setErrorMessage(`Error fetching bus stops: ${error.message}`);
    }
  };

  const fetchBusStopDetails = async (busStop) => {
    setLoadingDetails(true);
    try {
      const response = await API.get(`/bus-stops/${busStop.bus_stop_id}`);
      const busStopData = response.data;

      // Filter and sort schedule
      const currentDay = new Date().getDay();
      const filteredSchedule = busStopData.schedule
        .filter((schedule) => schedule.bus_schedule_day === currentDay)
        .filter((schedule) => {
          return schedule.bus_schedule_time > dayjs().format("HH:mm:ss");
        })
        .sort((a, b) => {
          const timeA = dayjs(a.bus_schedule_time, "HH:mm:ss");
          const timeB = dayjs(b.bus_schedule_time, "HH:mm:ss");

          // Sort ASC
          return timeA - timeB;
        });

      setBusStopDetails({
        ...busStopData,
        schedule: filteredSchedule,
      });
      
      setErrorMessage(''); // Clear error message
    } catch (error) {
      setErrorMessage(`Error fetching bus schedule: ${error.message}`);
    } finally {
      setLoadingDetails(false);
    }
  };

  const handleBusStopClick = (busStop) => {
    setSelectedBusStop(busStop);
    fetchBusStopDetails(busStop);
  };
  const closeBusStopDetail = () => {
    setSelectedBusStop(null);
    setBusStopDetails(null);
  };

  return (
    <div className="flex flex-col items-center justify-center min-h-screen bg-gray-100">
      <h1 className="text-3xl font-semibold mb-4">
        Incube8 - Simple Bus Service App by Will.T
      </h1>
      <Button label="Find Nearest Bus Stops" onClick={fetchNearestBusStops} />
      { errorMessage !== "" && <p>{errorMessage}</p>}
      <BusStopList busStops={busStops} onBusStopClick={handleBusStopClick} />
      {selectedBusStop && (
        <BusStopDetail
          busStop={busStopDetails}
          onClose={closeBusStopDetail}
          loading={loadingDetails}
        />
      )}
    </div>
  );
}

export default App;
