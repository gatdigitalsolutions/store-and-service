CREATE DATABASE store_and_service_management;
USE store_and_service_management;

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `Role` varchar(45) DEFAULT NULL,
  `Username` varchar(45) NOT NULL,
  `Passkey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `PhoneNo` varchar(15) DEFAULT NULL,
  `ServiceType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `clientservice` (
  `idClientService` int(11) NOT NULL,
  `TypeOfService_idTypeOfService` int(11) NOT NULL,
  `Client_idClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `deliveredchargers` (
  `idDelivered` int(11) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Ordered_idOrdered` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `deliveredcomponents` (
  `idDelivered` int(11) NOT NULL,
  `Ordered_idOrderedcomponent` int(11) NOT NULL DEFAULT 0,
  `Model` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `generator` (
  `idGenerator` int(11) NOT NULL,
  `GeneratorName` varchar(45) DEFAULT NULL,
  `TurboCharger_idTurboCharger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `heavyvehicle` (
  `idHeavyVehicle` int(11) NOT NULL,
  `HVname` varchar(45) DEFAULT NULL,
  `TurboCharger_idTurboCharger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `lightvehicle` (
  `idLightVehicle` int(11) NOT NULL,
  `LVname` varchar(45) DEFAULT NULL,
  `TurboCharger_idTurboCharger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `machinaries` (
  `idMachinaries` int(11) NOT NULL,
  `MachinaryName` varchar(45) DEFAULT NULL,
  `TurboCharger_idTurboCharger` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `orderedchargers` (
  `idOrdered` int(11) NOT NULL,
  `ToBeOrdered_idToBeOrdered` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT 0,
  `Type` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--

CREATE TABLE `orderedcomponents` (
  `idOrderedcomponent` int(11) NOT NULL,
  `ToBeOrderedComponent_idToBeOrderedComponent` int(11) NOT NULL DEFAULT 0,
  `Model` varchar(50) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `tobeorderedchargers` (
  `idToBeOrdered` int(11) NOT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `tobeorderedcomponents` (
  `idToBeOrderedComponent` int(11) NOT NULL,
  `Type` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `turbocharger` (
  `idTurboCharger` int(11) NOT NULL,
  `TurboName` varchar(45) DEFAULT NULL,
  `TurboModel` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `typeofservice` (
  `idTypeOfService` int(11) NOT NULL,
  `ServiceName` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `Username_UNIQUE` (`Username`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Indexes for table `clientservice`
--
ALTER TABLE `clientservice`
  ADD PRIMARY KEY (`idClientService`),
  ADD KEY `fk_ClientService_TypeOfService_idx` (`TypeOfService_idTypeOfService`),
  ADD KEY `fk_ClientService_Client_idx` (`Client_idClient`);

--
-- Indexes for table `deliveredchargers`
--
ALTER TABLE `deliveredchargers`
  ADD PRIMARY KEY (`idDelivered`),
  ADD KEY `fk_DeliveredChargers_OrderedChargers_idx` (`Ordered_idOrdered`);

--
-- Indexes for table `deliveredcomponents`
--
ALTER TABLE `deliveredcomponents`
  ADD PRIMARY KEY (`idDelivered`),
  ADD KEY `fk_DeliveredChargers_OrderedChargers_idx` (`Ordered_idOrderedcomponent`);

--
-- Indexes for table `generator`
--
ALTER TABLE `generator`
  ADD PRIMARY KEY (`idGenerator`),
  ADD KEY `fk_Generator_TurboCharger_idx` (`TurboCharger_idTurboCharger`);

--
-- Indexes for table `heavyvehicle`
--
ALTER TABLE `heavyvehicle`
  ADD PRIMARY KEY (`idHeavyVehicle`),
  ADD KEY `fk_HeavyVehicle_TurboCharger_idx` (`TurboCharger_idTurboCharger`);

--
-- Indexes for table `lightvehicle`
--
ALTER TABLE `lightvehicle`
  ADD PRIMARY KEY (`idLightVehicle`),
  ADD KEY `fk_LightVehicle_TurboCharger_idx` (`TurboCharger_idTurboCharger`);

--
-- Indexes for table `machinaries`
--
ALTER TABLE `machinaries`
  ADD PRIMARY KEY (`idMachinaries`),
  ADD KEY `fk_Machinaries_TurboCharger_idx` (`TurboCharger_idTurboCharger`);

--
-- Indexes for table `orderedchargers`
--
ALTER TABLE `orderedchargers`
  ADD PRIMARY KEY (`idOrdered`),
  ADD KEY `fk_OrderedChargers_ToBeOrderedChargers_idx` (`ToBeOrdered_idToBeOrdered`);

--
-- Indexes for table `orderedcomponents`
--
ALTER TABLE `orderedcomponents`
  ADD PRIMARY KEY (`idOrderedcomponent`),
  ADD KEY `fk_OrderedComponents_ToBeOrderedComponents_idx` (`ToBeOrderedComponent_idToBeOrderedComponent`);

--
-- Indexes for table `tobeorderedchargers`
--
ALTER TABLE `tobeorderedchargers`
  ADD PRIMARY KEY (`idToBeOrdered`);

--
-- Indexes for table `tobeorderedcomponents`
--
ALTER TABLE `tobeorderedcomponents`
  ADD PRIMARY KEY (`idToBeOrderedComponent`);

--
-- Indexes for table `turbocharger`
--
ALTER TABLE `turbocharger`
  ADD PRIMARY KEY (`idTurboCharger`);

--
-- Indexes for table `typeofservice`
--
ALTER TABLE `typeofservice`
  ADD PRIMARY KEY (`idTypeOfService`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `clientservice`
--
ALTER TABLE `clientservice`
  MODIFY `idClientService` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveredchargers`
--
ALTER TABLE `deliveredchargers`
  MODIFY `idDelivered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `deliveredcomponents`
--
ALTER TABLE `deliveredcomponents`
  MODIFY `idDelivered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `generator`
--
ALTER TABLE `generator`
  MODIFY `idGenerator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `heavyvehicle`
--
ALTER TABLE `heavyvehicle`
  MODIFY `idHeavyVehicle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lightvehicle`
--
ALTER TABLE `lightvehicle`
  MODIFY `idLightVehicle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machinaries`
--
ALTER TABLE `machinaries`
  MODIFY `idMachinaries` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderedchargers`
--
ALTER TABLE `orderedchargers`
  MODIFY `idOrdered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `orderedcomponents`
--
ALTER TABLE `orderedcomponents`
  MODIFY `idOrderedcomponent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tobeorderedchargers`
--
ALTER TABLE `tobeorderedchargers`
  MODIFY `idToBeOrdered` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tobeorderedcomponents`
--
ALTER TABLE `tobeorderedcomponents`
  MODIFY `idToBeOrderedComponent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `turbocharger`
--
ALTER TABLE `turbocharger`
  MODIFY `idTurboCharger` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typeofservice`
--
ALTER TABLE `typeofservice`
  MODIFY `idTypeOfService` int(11) NOT NULL AUTO_INCREMENT;


--
ALTER TABLE `clientservice`
  ADD CONSTRAINT `fk_ClientService_Client` FOREIGN KEY (`Client_idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ClientService_TypeOfService` FOREIGN KEY (`TypeOfService_idTypeOfService`) REFERENCES `typeofservice` (`idTypeOfService`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `generator`
--
ALTER TABLE `generator`
  ADD CONSTRAINT `fk_Generator_TurboCharger` FOREIGN KEY (`TurboCharger_idTurboCharger`) REFERENCES `turbocharger` (`idTurboCharger`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `heavyvehicle`
--
ALTER TABLE `heavyvehicle`
  ADD CONSTRAINT `fk_HeavyVehicle_TurboCharger` FOREIGN KEY (`TurboCharger_idTurboCharger`) REFERENCES `turbocharger` (`idTurboCharger`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lightvehicle`
--
ALTER TABLE `lightvehicle`
  ADD CONSTRAINT `fk_LightVehicle_TurboCharger` FOREIGN KEY (`TurboCharger_idTurboCharger`) REFERENCES `turbocharger` (`idTurboCharger`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `machinaries`
  ADD CONSTRAINT `fk_Machinaries_TurboCharger` FOREIGN KEY (`TurboCharger_idTurboCharger`) REFERENCES `turbocharger` (`idTurboCharger`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

