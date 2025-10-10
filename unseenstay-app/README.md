# UnseenStay CMS Mobile App

Android application for managing the UnseenStay CMS on the go.

## Features

- 🔐 Secure login to the CMS
- 📱 Mobile-optimized UI for CMS management
- 🏠 Manage properties and destinations
- 📝 Edit content on the go
- 📸 Upload and manage images
- 🔄 Real-time sync with the web CMS

## Prerequisites

- Android Studio Flamingo (2022.2.1) or newer
- Java Development Kit (JDK) 17
- Android SDK 33 (Android 13)
- Node.js (for API development)

## Setup

1. Clone the repository
2. Open the project in Android Studio
3. Configure your API endpoint in `app/src/main/java/com/unseenstay/cms/AppConfig.kt`
4. Build and run the app

## Building the APK

1. In Android Studio, go to `Build > Generate Signed Bundle / APK`
2. Select `APK` and click `Next`
3. Create or select a keystore
4. Fill in the required details
5. Select `release` build type
6. Click `Finish` to build the APK

The APK will be generated at:
`app/build/outputs/apk/release/app-release.apk`

## API Integration

The app connects to your existing CMS backend. Make sure your backend is running and accessible from the device/emulator.

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
