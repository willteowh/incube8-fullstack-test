import dayjs from "dayjs";
import { Loading } from "./ui/";

const BusStopList = ({ busStops, onBusStopClick }) => (
  <div className="mt-6 space-y-4">
    {busStops.map((busStop, index) => (
      <BusStopItem
        key={index}
        busStop={busStop}
        onClick={() => onBusStopClick(busStop)}
      />
    ))}
  </div>
);

const BusStopItem = ({ busStop, onClick }) => (
  <div
    onClick={onClick}
    className="px-4 py-2 bg-white rounded-md shadow-md cursor-pointer hover:bg-gray-200"
  >
    <h3 className="text-lg font-semibold">{busStop.bus_stop_name}</h3>
    <p>{busStop.distance.toFixed(2)} km away</p>
  </div>
);

const getRelativeTime = (time) => {
  const now = dayjs();
  const busTime = dayjs(`${now.format("YYYY-MM-DD")}T${time}`);
  const diffMinutes = busTime.diff(now, 'minute');
  let numHour =  Math.floor(diffMinutes / 60)
  let numMin = diffMinutes % 60
  return `${numHour ? `${numHour} hours ` : ''}${numMin} minutes`;
};

const BusStopDetail = ({ busStop, onClose, loading }) => (
  <div className="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div className="px-6 py-4 bg-white rounded-md shadow-lg">
      {loading ? (
        <Loading />
      ) : (
        <>
          <h3 className="text-xl font-semibold">Bus Stop: {busStop.name}</h3>
          {busStop.schedule.length > 0 ? (
            <>
              <p>
                Next Bus: {busStop.schedule[0].bus_name}, coming in{" "}
                {getRelativeTime(busStop.schedule[0].bus_schedule_time)}
              </p>
              <p>
                Following Bus: {busStop.schedule[1].bus_name}, coming in{" "}
                {getRelativeTime(busStop.schedule[1].bus_schedule_time)}
              </p>
            </>
          ) : (
            <p>No more buses today.</p>
          )}
          <button
            onClick={onClose}
            className="mt-4 px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700"
          >
            Close
          </button>
        </>
      )}
    </div>
  </div>
);

export { BusStopList, BusStopItem, BusStopDetail };
