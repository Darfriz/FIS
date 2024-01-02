import 'package:flutter/material.dart';

class FlightBookingPage extends StatefulWidget {
  const FlightBookingPage({Key? key}) : super(key: key);

  @override
  _FlightBookingPageState createState() => _FlightBookingPageState();
}

class _FlightBookingPageState extends State<FlightBookingPage> {
  // Selected values
  DateTime selectedDate = DateTime.now();
  String selectedFromDestination = 'Kangar Private Airport (KPA)';
  String selectedToDestination = 'Kangar Private Airport (KPA)';
  int selectedPassengers = 1;

  // User input controllers
  TextEditingController nameController = TextEditingController();
  TextEditingController emailController = TextEditingController();

  // Total price
  double totalPrice = 0.0;

  get selectedTime => null;

  get selectedLocation => null;

  // Function to calculate total price
  void calculateTotalPrice() {
    Map<String, Map<String, double>> prices = {
      // Your existing prices map
    };

    totalPrice = prices[selectedFromDestination]![selectedToDestination]! *
        selectedPassengers;

    setState(() {});
  }

  // Function to show date picker
  Future<void> _selectDate(BuildContext context) async {
    final DateTime? picked = await showDatePicker(
      context: context,
      initialDate: DateTime.now(),
      firstDate: DateTime.now(),
      lastDate: DateTime(2101),
    );

    if (picked != null && picked != selectedDate) {
      setState(() {
        selectedDate = picked;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Flight Booking'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const Text(
              'Passenger Details',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: () {
                // Handle booking submission
                print('Booking submitted with:');
                print('Departure Time: $selectedTime');
                print('Departure Date: $selectedDate');
                print('Departure Location: $selectedLocation');
              },
              child: const Text('Book Flight'),
            ),
          ],
        ),
      ),
    );
  }
}

