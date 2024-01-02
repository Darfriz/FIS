// profile_page.dart
import 'package:flutter/material.dart';

class ProfilePage extends StatelessWidget {
  const ProfilePage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Profile Page'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.center,
          children: [
            const CircleAvatar(
              radius: 80,
              backgroundImage: NetworkImage(
                  'https://placekitten.com/200/200'), // Replace with your image URL
            ),
            const SizedBox(height: 16),
            const Text(
              'John Doe',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),
            const Text(
              'UI/UX Designer',
              style: TextStyle(color: Colors.grey, fontSize: 18),
            ),
            const SizedBox(height: 16),
            const Divider(),
            const SizedBox(height: 16),
            const ListTile(
              leading: Icon(Icons.email),
              title: Text('john.doe@example.com', style: TextStyle(fontSize: 18)),
            ),
            const ListTile(
              leading: Icon(Icons.phone),
              title: Text('+1 123 456 7890', style: TextStyle(fontSize: 18)),
            ),
            const ListTile(
              leading: Icon(Icons.location_on),
              title: Text('New York, USA', style: TextStyle(fontSize: 18)),
            ),
            const SizedBox(height: 16),
            ElevatedButton(
              onPressed: () {
                // Handle button press
              },
              child: const Text('Edit Profile'),
            ),
          ],
        ),
      ),
    );
  }
}
